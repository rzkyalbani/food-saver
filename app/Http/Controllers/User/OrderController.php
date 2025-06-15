<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Xendit\Invoice\CreateInvoiceRequest;

class OrderController extends Controller
{
    public function store(Request $request, Offer $offer)
    {

        if (Auth::check() && Auth::user()->role === 'store_owner') {
            return redirect()->route('home')->with('error', 'Akun mitra tidak dapat melakukan pembelian. Silakan gunakan akun pelanggan.');
        }

        DB::beginTransaction();

        try {
            if ($offer->quantity_remaining <= 0) {
                return redirect()->back()->with('error', 'Mohon maaf, stok untuk penawaran ini sudah habis.');
            }

            $offer->decrement('quantity_remaining');

            $order = Order::create([
                'user_id' => Auth::id(),
                'offer_id' => $offer->id,
                'order_code' => 'FS-' . strtoupper(Str::random(8)),
                'quantity' => 1,
                'total_price' => $offer->discounted_price,
                'status' => 'pending_payment',
            ]);

            // ================== INI ADALAH PERBAIKAN FINAL ==================

            $config = new \Xendit\Configuration();
            $config->setApiKey(env('XENDIT_SECRET_KEY'));
            $apiInstance = new \Xendit\Invoice\InvoiceApi(null, $config);

            $cleanedPhoneNumber = preg_replace('/[^0-9]/', '', Auth::user()->phone_number);

            $create_invoice_request = new CreateInvoiceRequest([
                'external_id' => $order->order_code,
                'amount' => $order->total_price,
                'description' => 'Pembayaran untuk ' . $offer->name . ' (' . $order->order_code . ')',
                'payer_email' => Auth::user()->email,
                'currency' => 'IDR',
                'customer' => [
                    'given_names' => Auth::user()->name,
                    'email' => Auth::user()->email,
                    'mobile_number' => $cleanedPhoneNumber,
                ],
                'success_redirect_url' => route('order.success', $order),
                'failure_redirect_url' => route('home'), // Atau halaman spesifik jika pembayaran gagal
                'payment_methods' => ['EWALLET', 'QRIS', 'RETAIL_OUTLET'],
                'invoice_duration' => 900, // 15 menit * 60 detik = 900 detik
            ]);

            // Buat invoice menggunakan objek request tersebut
            $result = $apiInstance->createInvoice($create_invoice_request);

            // ===============================================================

            $order->payment_url = $result['invoice_url'];
            $order->save();

            DB::commit();

            return redirect($result['invoice_url']);
        } catch (\Exception $e) {
            DB::rollBack();
            // Kembalikan ke pesan error yang lebih informatif untuk production
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghubungi sistem pembayaran: ' . $e->getMessage());
        }
    }

    public function success(Order $order)
    {
        // Halaman ini akan menjadi tujuan setelah pembayaran di Xendit berhasil
        if ($order->user_id !== Auth::id()) {
            return redirect()->route('home')->with('error', 'Pesanan tidak valid.');
        }

        // Kita akan bahas verifikasi status pembayaran via webhook di bagian selanjutnya
        // Untuk sekarang, kita asumsikan jika sudah sampai sini, pembayaran berhasil.
        // Sebaiknya kita update statusnya di sini sebagai fallback.
        if ($order->status === 'pending_payment') {
            $order->status = 'paid';
            $order->paid_at = now();
            $order->save();
        }

        return view('order-success', compact('order'));
    }
}
