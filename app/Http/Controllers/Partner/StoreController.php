<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Cek apakah user sudah punya toko
        if (auth()->user()->stores()->exists()) {
            return redirect()->route('partner.dashboard')->with('error', 'Anda sudah memiliki toko terdaftar.');
        }
        return view('partner.stores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string',
            'phone_number' => 'required|string',
            // Untuk latitude & longitude, sementara kita buat opsional
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        auth()->user()->stores()->create([
            'name' => $request->name,
            'description' => $request->description,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'status' => 'pending', // Status awal saat dibuat adalah 'pending' untuk verifikasi admin
        ]);

        return redirect()->route('partner.dashboard')->with('status', 'Toko Anda berhasil dibuat dan sedang menunggu persetujuan admin.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Store $store)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Store $store)
    {
        // Pastikan user hanya bisa edit tokonya sendiri
        if ($store->user_id !== auth()->id()) {
            abort(403);
        }
        return view('partner.stores.edit', compact('store'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Store $store)
    {
        // Pastikan user hanya bisa update tokonya sendiri
        if ($store->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string',
            'phone_number' => 'required|string',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        // Saat di-update, kembalikan status ke 'pending' agar admin bisa review ulang
        $validated['status'] = 'pending';

        $store->update($validated);

        return redirect()->route('partner.dashboard')->with('status', 'Informasi toko berhasil diperbarui dan akan ditinjau ulang oleh Admin.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $store)
    {
        //
    }
}
