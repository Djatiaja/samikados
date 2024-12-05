<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestNotificationController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Middleware\VerifyMustHaveEmail;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Expr\FuncCall;

Route::get('/', function () {
    return redirect("/login");
});


Route::get('/verification-otp', function () {
    return view('auth.verification-otp');
})->name('verification-otp')->middleware(VerifyMustHaveEmail::class);

Route::get('/reset-password-fe', function () {
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

// 

//                                                  ADMIN
//jangan lupa tambahkan middleware ['auth', 'role:admin', 'verify'] ketika selesai
Route::middleware([])->prefix('/admin')->group(function(){

    Route::controller(AdminController::class)->prefix("")->group(function () {
        Route::get("/", "index")->name("dashboard");
        Route::get("/laporan", "laporan")->name("admin-laporan");
        Route::get("/notifikasi", "notifikasi")->name("admin-notifikasi");
    });

    Route::controller(ProfileController::class)->prefix('/pengaturan-akun')->group(function () {
        Route::get('/', 'index')->name('pengaturan-akun');
        Route::put('/update/{id}', 'update')->name('pengaturan-akun.update');
        Route::post('/tambah-admin', 'tambahAdmin')->name('pengaturan-akun.tambah-admin');
        Route::post('/ganti-password', 'changePassword')->name('pengaturan-akun.changePassword');
        Route::put('/update/photo/{id}', 'changePhoto')->name('pengaturan-akun.update-profile');
    });

    Route::controller(WithdrawalController::class)->prefix('/manajemen-withdrawal')->group(function () {
        Route::get("/", "index")->name("manajemen-withdrawal");
        Route::put("/update/{id}", "update")->name("manajemen-withdrawal.update");
        Route::get("/search", "search")->name("manajemen-withdrawal.search");
    });

    Route::controller(CategoryController::class)->prefix("/manajemen-kategori")->group(function () {
        Route::get('/', 'index')->name('manajemen-kategori');
        Route::post("/store", "store")->name("manajemen-kategori.store");
        Route::post("/update/{id}", "update")->name("manajemen-kategori.update");
        Route::delete("/delete/{id}", "delete")->name("manajemen-kategori.delete");
    });

    Route::controller(AccountController::class)->prefix("/manajemen-akun")->group(function () {
        Route::get("/", "index")->name("manajemen-akun");
        Route::put("/suspend/{id}", "suspend")->name("manajemen-akun.suspend");
        Route::put("/unsuspend/{id}", "unsuspend")->name("manajemen-akun.unsuspend");
        Route::get("/search", "search")->name("manajemen-akun.search");
    });

    Route::controller(ProductController::class)->prefix("/manajemen-produk")->group(function () {
        Route::get("/", "index")->name("manajemen-produk");
        Route::put("/unpublish/{id}", "unpublish")->name("manajemen-produk.unpublish");
        Route::get("/search", "search")->name("manajemen-produk.search");
    });

});

// ===================================          Seller          =================================
Route::controller(TestNotificationController::class)->group(function(){
    Route::get("/test-notification", "index");
    Route::post("/test-notification", "store")->name('test-notify');
});

require __DIR__ . '/auth.php';
