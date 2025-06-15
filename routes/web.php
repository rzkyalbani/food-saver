<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\Partner\OrderConfirmationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\OrderController as UserOrderController;
use App\Http\Controllers\OnboardingController;
use App\Http\Controllers\Partner\DashboardController as PartnerDashboardController;
use App\Http\Controllers\Partner\StoreController as PartnerStoreController;
use App\Http\Controllers\Partner\OfferController as PartnerOfferController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rute Publik (dapat diakses oleh semua pengunjung)
//--------------------------------------------------------------------------
Route::get('/', [HomeController::class, 'index'])->name('home'); // Halaman utama aplikasi
Route::get('/offers', [OfferController::class, 'index'])->name('offers.index'); // Halaman katalog semua penawaran
Route::get('/offers/{offer}', [OfferController::class, 'show'])->name('offers.show'); // Menampilkan detail satu penawaran
Route::post('/set-location', [HomeController::class, 'setLocation'])->name('set.location'); // Menyimpan lokasi pengguna di session untuk pencarian

// Rute untuk Pengguna Terautentikasi (Umum)
//--------------------------------------------------------------------------
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard'); // Dashboard pengguna (riwayat pesanan)

// Grup Rute untuk Pengguna Terautentikasi
//--------------------------------------------------------------------------
Route::middleware('auth')->group(function () {
    // Rute untuk Manajemen Profil Pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute untuk Proses Onboarding Menjadi Mitra
    Route::get('/become-a-partner', [OnboardingController::class, 'index'])->name('onboarding.index');
    Route::post('/become-a-partner/step1', [OnboardingController::class, 'storeStep1'])->name('onboarding.storeStep1');
    Route::post('/become-a-partner/step2', [OnboardingController::class, 'storeStep2'])->name('onboarding.storeStep2');
    Route::post('/become-a-partner/process', [OnboardingController::class, 'process'])->name('onboarding.process');
    Route::get('/become-a-partner/back', [OnboardingController::class, 'back'])->name('onboarding.back');

    // Rute untuk Proses Pemesanan oleh Pengguna
    Route::post('/order/create/{offer}', [UserOrderController::class, 'store'])->name('order.store'); // Membuat pesanan baru
    Route::get('/order/success/{order}', [UserOrderController::class, 'success'])->name('order.success'); // Halaman sukses setelah pembayaran
});

// Grup Rute untuk Mitra (Store Owner)
//--------------------------------------------------------------------------
Route::group([
    'middleware' => ['auth', 'verified', 'is_store_owner'], // Memastikan pengguna adalah mitra
    'prefix' => 'partner', // Semua rute dalam grup ini akan diawali dengan /partner
    'as' => 'partner.' // Semua nama rute dalam grup ini akan diawali dengan partner.
], function () {
    // Dashboard Mitra
    Route::get('/dashboard', [PartnerDashboardController::class, 'index'])->name('dashboard');

    // Manajemen Toko (CRUD untuk toko milik mitra)
    Route::resource('stores', PartnerStoreController::class);

    // Manajemen Penawaran (CRUD untuk penawaran milik toko mitra)
    Route::resource('offers', PartnerOfferController::class);

    // Konfirmasi Pengambilan Pesanan oleh Mitra
    Route::get('/confirm-order', [OrderConfirmationController::class, 'index'])->name('order.confirm.index'); // Halaman formulir konfirmasi
    Route::post('/confirm-order', [OrderConfirmationController::class, 'confirm'])->name('order.confirm.submit'); // Proses submit konfirmasi
});

// Rute Autentikasi Bawaan Laravel
// (Login, Register, Forgot Password, dll.)
//--------------------------------------------------------------------------
require __DIR__ . '/auth.php';
