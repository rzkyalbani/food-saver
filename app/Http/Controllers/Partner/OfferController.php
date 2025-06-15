<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $store = Auth::user()->stores()->first();
        if (!$store || $store->status !== 'approved') {
            return redirect()->route('partner.dashboard')->with('error', 'Toko Anda belum disetujui atau tidak ditemukan. Anda tidak dapat mengelola penawaran.');
        }
        $offers = $store->offers()->orderBy('created_at', 'desc')->paginate(10);
        return view('partner.offers.index', compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $store = Auth::user()->stores()->first();
        if (!$store || $store->status !== 'approved') {
            return redirect()->route('partner.dashboard')->with('error', 'Toko Anda belum disetujui atau tidak ditemukan. Anda tidak dapat membuat penawaran.');
        }
        return view('partner.offers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'original_price' => 'required|integer|min:0',
            'discounted_price' => 'required|integer|min:0|lt:original_price',
            'quantity_initial' => 'required|integer|min:1',
            'pickup_start_time' => 'required|date',
            'pickup_end_time' => 'required|date|after:pickup_start_time',
        ]);

        $store = Auth::user()->stores()->firstOrFail();

        // Pastikan toko sudah approved sebelum membuat penawaran
        if ($store->status !== 'approved') {
            return redirect()->route('partner.offers.index')->with('error', 'Toko Anda belum disetujui. Anda tidak dapat menambahkan penawaran.');
        }

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('offers', 'public');
        }

        $store->offers()->create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'image' => $imagePath,
            'original_price' => $validated['original_price'],
            'discounted_price' => $validated['discounted_price'],
            'quantity_initial' => $validated['quantity_initial'],
            'quantity_remaining' => $validated['quantity_initial'],
            'pickup_start_time' => $validated['pickup_start_time'],
            'pickup_end_time' => $validated['pickup_end_time'],
        ]);

        return redirect()->route('partner.offers.index')->with('status', 'Penawaran baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Offer $offer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Offer $offer)
    {
        $store = Auth::user()->stores()->first();
        if (!$store || $offer->store_id !== $store->id) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit penawaran ini.');
        }

        return view('partner.offers.edit', compact('offer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Offer $offer)
    {
        // Pastikan offer ini milik store dari user yang sedang login
        $store = Auth::user()->stores()->first();
        if (!$store || $offer->store_id !== $store->id) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit penawaran ini.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'original_price' => 'required|integer|min:0',
            'discounted_price' => 'required|integer|min:0|lt:original_price',
            'quantity_initial' => 'required|integer|min:1',
            'pickup_start_time' => 'required|date',
            'pickup_end_time' => 'required|date|after:pickup_start_time',
            'status' => 'required|in:active,inactive,sold_out',
        ]);

        $updateData = [
            'name' => $validated['name'],
            'description' => $validated['description'],
            'original_price' => $validated['original_price'],
            'discounted_price' => $validated['discounted_price'],
            'pickup_start_time' => $validated['pickup_start_time'],
            'pickup_end_time' => $validated['pickup_end_time'],
            'status' => $validated['status'],
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($offer->image && Storage::disk('public')->exists($offer->image)) {
                Storage::disk('public')->delete($offer->image);
            }
            
            // Upload dan simpan gambar baru
            $image = $request->file('image');
            $imagePath = $image->store('offers', 'public');
            $updateData['image'] = $imagePath;
        }

        // Logika penyesuaian quantity_remaining jika quantity_initial diubah
        if ($offer->quantity_initial != $validated['quantity_initial']) {
            $soldQuantity = $offer->quantity_initial - $offer->quantity_remaining;
            $newRemaining = $validated['quantity_initial'] - $soldQuantity;

            if ($newRemaining < 0) {
                // Ini berarti stok awal baru lebih kecil dari yang sudah terjual, ini tidak ideal.
                // Redirect dengan error atau set remaining ke 0.
                return redirect()->back()->withInput()->with('error', 'Stok awal baru tidak boleh lebih kecil dari jumlah yang sudah terjual.');
            }
            $updateData['quantity_initial'] = $validated['quantity_initial'];
            $updateData['quantity_remaining'] = $newRemaining;
        }

        $offer->update($updateData);

        return redirect()->route('partner.offers.index')->with('status', 'Penawaran berhasil diperbarui!');
    }   

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Offer $offer)
    {
        // Pastikan offer ini milik store dari user yang sedang login
        $store = Auth::user()->stores()->first();
        if (!$store || $offer->store_id !== $store->id) {
            abort(403, 'Anda tidak memiliki izin untuk menghapus penawaran ini.');
        }

        // Tambahan: Cek apakah ada pesanan aktif terkait penawaran ini?
        // Jika ada, mungkin tidak boleh dihapus atau perlu penanganan khusus.
        // Untuk saat ini, kita langsung hapus.
        if ($offer->orders()->whereIn('status', ['paid', 'pending_payment'])->exists()) {
            return redirect()->route('partner.offers.index')->with('error', 'Penawaran tidak dapat dihapus karena masih memiliki pesanan aktif atau menunggu pembayaran.');
        }

        $offer->delete();

        return redirect()->route('partner.offers.index')->with('status', 'Penawaran berhasil dihapus!');
    }
}
