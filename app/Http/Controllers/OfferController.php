<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    // Menampilkan semua penawaran di halaman utama
    public function index()
    {
        // Ambil semua penawaran yang kuantitasnya > 0 dan waktu pengambilannya belum lewat
        $offers = Offer::where('quantity', '>', 0)
            ->where('pickup_end_time', '>', now())
            ->latest()
            ->get();

        // Kirim data ke view 'welcome'
        return view('welcome', compact('offers'));
    }

    // Menampilkan detail satu penawaran
    // Laravel akan otomatis mencari Offer berdasarkan {offer} di URL (Route Model Binding)
    public function show(Offer $offer)
    {
        return view('offers.show', compact('offer'));
    }
}
