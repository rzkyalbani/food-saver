<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil pesanan milik user yang sedang login
        // Gunakan with() untuk eager loading agar query lebih efisien
        $orders = Auth::user()->orders()
            ->with('offer.store') // Ambil juga data offer dan store terkait
            ->latest() // Urutkan dari yang terbaru
            ->paginate(10); // Batasi 10 per halaman

        return view('dashboard', compact('orders'));
    }
}
