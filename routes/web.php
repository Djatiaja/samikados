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

Route::get('/forgot-password', function () {
    return view('forgot-password');
})->name('forgot-password');

Route::get('/verification-otp', function () {
    return view('auth.verification-otp');
})->name('verification-otp')->middleware(VerifyMustHaveEmail::class);

Route::get('/reset-password-fe', function () {
    return view('reset-password-fe');
})->name('reset-password-fe');

//FE - Dashboard
Route::view('/admin/kategori-fe', 'kategori-fe')->name('kategori-fe');
Route::view('/admin/produk-fe', 'produk-fe')->name('produk-fe');
Route::view('/admin/detail-produk-fe', 'detail-produk-fe')->name('detail-produk-fe');
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
