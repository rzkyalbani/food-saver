<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil penawaran yang aktif dan toko yang approved
        $offers = Offer::where('status', 'active')
            ->whereHas('store', function ($query) {
                $query->where('status', 'approved');
            })
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        // Ambil statistik dasar (dapat ditambahkan nanti dari database)
        $stats = [
            'saved_meals' => Offer::whereHas('orders', function ($query) {
                $query->where('status', 'completed');
            })->sum('quantity_initial') - Offer::whereHas('orders', function ($query) {
                $query->where('status', 'completed');
            })->sum('quantity_remaining'),
            'partners' => Store::where('status', 'approved')->count(),
            'active_offers' => Offer::where('status', 'active')->count(),
        ];

        return view('home', compact('offers', 'stats'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function setLocation(Request $request)
    {
        try {
            $validated = $request->validate([
                'latitude' => 'required|numeric|between:-90,90',
                'longitude' => 'required|numeric|between:-180,180',
            ]);

            Session::put('user_lat', $validated['latitude']);
            Session::put('user_lon', $validated['longitude']);

            // Tambahkan informasi kota/alamat jika memungkinkan
            $locationInfo = $this->getLocationInfo($validated['latitude'], $validated['longitude']);
            
            return response()->json([
                'success' => true, 
                'message' => 'Lokasi berhasil disimpan.',
                'location_info' => $locationInfo
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan lokasi: ' . $e->getMessage()
            ], 422);
        }
    }

    /**
     * Fungsi untuk mendapatkan informasi lokasi dari koordinat (opsional)
     */
    private function getLocationInfo($latitude, $longitude)
    {
        // Ini adalah implementasi sederhana
        // Untuk produksi, Anda bisa menggunakan Google Geocoding API atau layanan serupa
        return [
            'formatted_address' => 'Lokasi Anda saat ini',
            'coordinates' => [
                'lat' => $latitude,
                'lng' => $longitude
            ]
        ];
    }
}
