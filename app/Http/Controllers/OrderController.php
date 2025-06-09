<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['offer_id' => 'required|exists:offers,id', 'quantity' => 'required|integer|min:1']);

        $offer = Offer::findOrFail($request->offer_id);

        // Cek Kuantitas
        if ($offer->quantity < $request->quantity) {
            return back()->with('error', 'Maaf, kuantitas tidak mencukupi.');
        }

        // Kurangi kuantitas penawaran
        $offer->decrement('quantity', $request->quantity);

        // Buat Pesanan
        $order = Order::create([
            'user_id' => Auth::id(),
            'offer_id' => $offer->id,
            'quantity' => $request->quantity,
            'total_price' => $offer->discounted_price * $request->quantity,
            'redemption_code' => strtoupper(Str::random(6)),
            'status' => 'pending', // Status awal: menunggu pembayaran
        ]);

        // Redirect ke halaman simulasi pembayaran
        return redirect()->route('orders.payment', $order);
    }
}
