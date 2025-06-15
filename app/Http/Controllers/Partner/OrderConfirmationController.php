<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderConfirmationController extends Controller
{
    public function index()
    {
        return view('partner.orders.confirm');
    }

    public function confirm(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'order_code' => 'required|string|',
        ]);

        // Cari pesanan berdasarkan kode
        $order = Order::where('order_code', $validated['order_code'])->first();

        // Validasi pesanan
        if (!$order) {
            return redirect()->back()->with('error', 'Kode pesanan tidak ditemukan.');
        }

        // Memastikan toko yang mengonfirmasi adalah toko yang memiliki penawaran ini
        $userStores = Auth::user()->stores->pluck('id')->toArray();
        if (!in_array($order->offer->store_id, $userStores)) {
            return redirect()->back()->with('error', 'Pesanan ini bukan untuk toko Anda.');
        }

        if ($order->status !== 'paid') {
            return redirect()->back()->with('error', 'Pesanan ini tidak bisa dikonfirmasi (Status saat ini: ' . $order->status . ').');
        }

        // Jika semua verifikasi lolos, update status pesanan
        $order->status = 'completed';
        $order->picked_up_at = now();
        $order->save();
        
        // Log aktivitas untuk analisis
        Log::info('Order completed', [
            'order_id' => $order->id,
            'order_code' => $order->order_code,
            'store_id' => $order->offer->store_id,
            'user_id' => $order->user_id,
            'completed_at' => $order->picked_up_at
        ]);

        // Kembalikan dengan pesan sukses
        return redirect()->back()->with('success', 'Pesanan dengan kode ' . $order->order_code . ' berhasil dikonfirmasi!');
    }
}