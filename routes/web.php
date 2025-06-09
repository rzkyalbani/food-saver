<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\Partner\OfferController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rute untuk Halaman Utama (Homepage)
Route::get('/', [OfferController::class, 'index'])->name('home');

// Rute untuk melihat detail satu penawaran
Route::get('/offers/{offer}', [OfferController::class, 'show'])->name('offers.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute untuk halaman pembayaran (simulasi)
    Route::get('/orders/{order}/payment', [OrderController::class, 'payment'])->name('orders.payment');
    // Rute untuk mengkonfirmasi pembayaran (simulasi)
    Route::post('/orders/{order}/pay', [OrderController::class, 'pay'])->name('orders.pay');
    // Rute untuk melihat semua pesanan milik pengguna
    Route::get('/my-orders', [OrderController::class, 'index'])->name('orders.index');
});

Route::post('/orders', [OrderController::class, 'store'])->name('orders.store')->middleware('auth');

Route::middleware(['auth', 'role:partner'])->prefix('partner')->name('partner.')->group(function () {
    // Rute untuk dashboard
    Route::get('/dashboard', [App\Http\Controllers\Partner\DashboardController::class, 'index'])->name('dashboard');

    // Rute untuk mengelola penawaran (CRUD)
    Route::resource('/offers', App\Http\Controllers\Partner\OfferController::class);
});

require __DIR__ . '/auth.php';
