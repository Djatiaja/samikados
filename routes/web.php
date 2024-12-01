<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProviderController;
use Illuminate\Http\Request ;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//FE
Route::get('/login-fe', function(){
    return view('login-fe');
})->name('login-fe');

Route::get('/forgot-password-fe', function(){
    return view('forgot-password-fe');
})->name('forgot-password-fe');

Route::get('/verification-otp-fe', function(){
    return view('verification-otp-fe');
})->name('verification-otp-fe');

Route::get('/reset-password-fe', function(){
    return view('reset-password-fe');
})->name('reset-password-fe');

//FE - Dashboard
Route::view('/admin/dashboard-fe', 'dashboard-fe')->name('dashboard-fe');
Route::view('/admin/manajemen-kategori-fe', 'manajemen-kategori-fe')->name('manajemen-kategori-fe');
Route::view('/admin/manajemen-akun-fe', 'manajemen-akun-fe')->name('manajemen-akun-fe');
Route::view('/admin/manajemen-produk-fe', 'manajemen-produk-fe')->name('manajemen-produk-fe');
Route::view('/admin/manajemen-banner-fe', 'manajemen-banner-fe')->name('manajemen-banner-fe');
Route::view('/admin/mapproval-withdraw-fe', 'approval-withdraw-fe')->name('approval-withdraw-fe');
Route::view('/admin/laporan-fe', 'laporan-fe')->name('laporan-fe');
Route::view('/admin/notifikasi-fe', 'notifikasi-fe')->name('notifikasi-fe');
Route::view('/admin/pengaturan-akun-fe', 'pengaturan-akun-fe')->name('pengaturan-akun-fe'); 
Route::view('/admin/kategori-fe', 'kategori-fe')->name('kategori-fe');
Route::view('/admin/produk-fe', 'produk-fe')->name('produk-fe');
Route::view('/admin/detail-produk-fe', 'detail-produk-fe')->name('detail-produk-fe');
Route::view('/admin/view-kategori-fe', 'view-kategori-fe')->name('view-kategori-fe');


// =======

// SELLER - FE
Route::get('/register-seller-fe', function(){
    return view('seller/register-seller-fe');
})->name('register-seller-fe');

Route::get('/login-seller-fe', function(){
    return view('seller/login-seller-fe');
})->name('login-seller-fe');

Route::get('/verify-seller-fe', function(){
    return view('seller/verify-email-fe');
})->name('verify-seller-fe');

Route::view('/seller/dashboard-fe', 'seller/dashboard-seller-fe')->name('dashboard-seller-fe');
Route::view('/seller/pesanan-fe', 'seller/pesanan-seller-fe')->name('pesanan-seller-fe');
Route::view('/seller/pengiriman-fe', 'seller/pengiriman-seller-fe')->name('pengiriman-seller-fe');
Route::view('/seller/manajemen-produk-fe', 'seller/manajemen-produk-seller-fe')->name('manajemen-produk-seller-fe');
Route::view('/seller/etalase-fe', 'seller/etalase-seller-fe')->name('etalase-seller-fe');
Route::view('/seller/history-fe', 'seller/history-seller-fe')->name('history-seller-fe');
Route::view('/seller/laporan-fe', 'seller/laporan-seller-fe')->name('laporan-seller-fe');
Route::view('/seller/ajukan-penarikan-fe', 'seller/ajukan-penarikan-seller-fe')->name('ajukan-penarikan-seller-fe');
Route::view('/seller/notifikasi-fe', 'seller/notifikasi-seller-fe')->name('notifikasi-seller-fe');
Route::view('/seller/pengaturan-akun-fe', 'seller/pengaturan-akun-seller-fe')->name('pengaturan-akun-seller-fe');
Route::view('/seller/view-fe', 'seller/seller-view-fe')->name('view-seller-fe');
Route::view('/seller/detail-produk-fe', 'seller/detail-produk-seller-fe')->name('detail-produk-seller-fe');
Route::view('/seller/view-kategori-seller-fe', 'seller/view-kategori-seller-fe')->name('view-kategori-seller-fe');

// =======
Route::get('/dashboard', function () {
    // dd(Auth::user());
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get("/auth/{provider}/redirect", [ProviderController::class, 'redirect']);
Route::get("/auth/{provider}/callback", [ProviderController::class, 'callback']);

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

require __DIR__.'/auth.php';
