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
Route::view('/admin/mapproval-withdraw-fe', 'approval-withdraw-fe')->name('approval-withdraw-fe');
Route::view('/admin/laporan-fe', 'laporan-fe')->name('laporan-fe');
Route::view('/admin/notifikasi-fe', 'notifikasi-fe')->name('notifikasi-fe');
Route::view('/admin/pengaturan-akun-fe', 'pengaturan-akun-fe')->name('pengaturan-akun-fe'); 
Route::view('/admin/kategori-fe', 'kategori-fe')->name('kategori-fe');
Route::view('/admin/produk-fe', 'produk-fe')->name('produk-fe');
Route::view('/admin/detail-produk-fe', 'detail-produk-fe')->name('detail-produk-fe');
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
