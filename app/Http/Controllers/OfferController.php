<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource (catalog page).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort = $request->input('sort', 'distance'); // Default sort by distance

        // Default location (e.g., Semarang), get from session if available
        $userLat = session('user_lat', -6.9926);
        $userLon = session('user_lon', 110.4208);

        $query = Offer::with('store')
            ->where('status', 'active')
            ->where('pickup_end_time', '>', now()) // TAMBAHKAN BARIS INI
            ->whereHas('store', function ($q) {
                $q->where('status', 'approved');
            });

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhereHas('store', function ($sq) use ($search) {
                        $sq->where('name', 'like', "%{$search}%");
                    });
            });
        }

        $offers = $query->get(); // Ambil semua offer yang cocok dulu sebelum menghitung jarak dan sorting

        $offersWithDistance = $offers->map(function ($offer) use ($userLat, $userLon) {
            if ($offer->store && $offer->store->latitude !== null && $offer->store->longitude !== null) {
                $lat1 = $userLat;
                $lon1 = $userLon;
                $lat2 = $offer->store->latitude;
                $lon2 = $offer->store->longitude;

                $earthRadius = 6371; // Earth radius in kilometers
                $dLat = deg2rad($lat2 - $lat1);
                $dLon = deg2rad($lon2 - $lon1);

                $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) * sin($dLon / 2);
                $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
                $distance = $earthRadius * $c; // Distance in KM
                $offer->distance = $distance;
            } else {
                $offer->distance = INF; // Jika tidak ada data lat/lon toko, set jarak tak terhingga
            }
            return $offer;
        });

        // Apply sorting
        if ($sort === 'distance') {
            $sortedOffers = $offersWithDistance->sortBy('distance');
        } elseif ($sort === 'price_low') {
            $sortedOffers = $offersWithDistance->sortBy('discounted_price');
        } elseif ($sort === 'price_high') {
            $sortedOffers = $offersWithDistance->sortByDesc('discounted_price');
        } elseif ($sort === 'discount') {
            $sortedOffers = $offersWithDistance->sortByDesc(function ($offer) {
                if ($offer->original_price > 0) { // Hindari pembagian dengan nol
                    return ($offer->original_price - $offer->discounted_price) / $offer->original_price;
                }
                return 0; // Atau nilai lain yang sesuai jika original_price adalah 0
            });
        } else { // Default sort (bisa juga created_at atau lainnya jika distance tidak relevan)
            $sortedOffers = $offersWithDistance->sortBy('distance');
        }

        $perPage = 12; // Items per page for catalog
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentPageItems = $sortedOffers->slice(($currentPage - 1) * $perPage, $perPage)->all();

        // Buat instance Paginator baru dari hasil sorting
        $paginatedOffers = new LengthAwarePaginator($currentPageItems, count($sortedOffers), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);

        // Append query string parameters to pagination links
        $paginatedOffers->appends($request->except('page'));

        return view('catalog', ['offers' => $paginatedOffers, 'search' => $search, 'sort' => $sort]);
    }

    /**
     * Display the specified resource (offer detail page).
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\View\View
     */
    public function show(Offer $offer)
    {
        $offer->load('store');

        if ($offer->store->status !== 'approved' || $offer->status !== 'active') {
            abort(404);
        }

        return view('offer-detail', compact('offer'));
    }
}