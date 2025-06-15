<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Store;
use Illuminate\Validation\Rule;

class OnboardingController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        // Jika user sudah jadi mitra dan punya toko, arahkan ke dashboard mitra
        if ($user->role === 'store_owner' && $user->stores()->exists()) {
            return redirect()->route('partner.dashboard');
        }

        // Tentukan step berdasarkan session
        $step = $request->session()->get('onboarding_step', 1);
        $storeData = $request->session()->get('onboarding_data', []);

        return view('onboarding', compact('step', 'storeData'));
    }

    public function storeStep1(Request $request)
    {
        $validatedData = $request->validate([
            'store_name' => 'required|string|max:255',
            'store_description' => 'required|string',
            'store_phone_number' => 'required|string|max:20',
        ]);

        // Simpan data ke session
        $request->session()->put('onboarding_data', array_merge(
            $request->session()->get('onboarding_data', []),
            $validatedData
        ));
        $request->session()->put('onboarding_step', 2);

        return redirect()->route('onboarding.index');
    }

    public function storeStep2(Request $request)
    {
        $validatedData = $request->validate([
            'store_address' => 'required|string',
            'store_latitude' => 'required|numeric|between:-90,90',
            'store_longitude' => 'required|numeric|between:-180,180',
        ]);

        // Simpan data ke session
        $request->session()->put('onboarding_data', array_merge(
            $request->session()->get('onboarding_data', []),
            $validatedData
        ));
        $request->session()->put('onboarding_step', 3);

        return redirect()->route('onboarding.index');
    }

    public function process(Request $request)
    {
        $user = Auth::user();

        // Jika user sudah punya toko, cegah pembuatan toko baru melalui onboarding
        if ($user->stores()->exists()) {
            return redirect()->route('partner.dashboard')->with('error', 'Anda sudah memiliki toko terdaftar.');
        }

        // Ambil data dari session
        $storeData = $request->session()->get('onboarding_data', []);

        // Validasi final (memastikan semua data ada)
        if (!isset($storeData['store_name']) || !isset($storeData['store_description']) || 
            !isset($storeData['store_phone_number']) || !isset($storeData['store_address']) || 
            !isset($storeData['store_latitude']) || !isset($storeData['store_longitude'])) {
            return redirect()->route('onboarding.index')->with('error', 'Data tidak lengkap, silakan ulangi proses pendaftaran.');
        }

        // Ubah peran pengguna menjadi store_owner jika belum
        if ($user->role !== 'store_owner') {
            $user->role = 'store_owner';
            $user->save();
        }

        // Buat toko baru
        $store = $user->stores()->create([
            'name' => $storeData['store_name'],
            'description' => $storeData['store_description'],
            'address' => $storeData['store_address'],
            'phone_number' => $storeData['store_phone_number'],
            'latitude' => $storeData['store_latitude'],
            'longitude' => $storeData['store_longitude'],
            'status' => 'pending', // Status awal saat dibuat adalah 'pending'
        ]);

        // Bersihkan session onboarding
        $request->session()->forget(['onboarding_step', 'onboarding_data']);

        return redirect()->route('partner.dashboard')->with('status', 'Pendaftaran toko Anda berhasil dikirim dan sedang menunggu persetujuan admin.');
    }

    public function back(Request $request)
    {
        $currentStep = $request->session()->get('onboarding_step', 1);
        $newStep = max(1, $currentStep - 1);
        $request->session()->put('onboarding_step', $newStep);
        
        return redirect()->route('onboarding.index');
    }
}