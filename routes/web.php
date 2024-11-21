<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Middleware\VerifyMustHaveEmail;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Expr\FuncCall;

Route::get('/', function () {
    return view('welcome');
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
Route::view('/admin/manajemen-akun-fe', 'manajemen-akun-fe')->name('manajemen-akun-fe');
Route::view('/admin/manajemen-produk-fe', 'manajemen-produk-fe')->name('manajemen-produk-fe');
Route::view('/admin/laporan-fe', 'laporan-fe')->name('laporan-fe');
Route::view('/admin/notifikasi-fe', 'notifikasi-fe')->name('notifikasi-fe');
Route::view('/admin/kategori-fe', 'kategori-fe')->name('kategori-fe');
Route::view('/admin/produk-fe', 'produk-fe')->name('produk-fe');
Route::view('/admin/detail-produk-fe', 'detail-produk-fe')->name('detail-produk-fe');
// 

Route::controller(AdminController::class)->prefix("/admin")->group(function(){
    Route::get("/", "index")->name("dashboard");
});

Route::controller(ProfileController::class)->prefix('/admin/pengaturan-akun')->middleware(["auth", "verified", "role:admin"])->group(function () {
    Route::get('/', 'index')->name('pengaturan-akun');
    Route::put('/update/{id}', 'update')->name('pengaturan-akun.update');
    Route::post('/tambah-admin', 'tambahAdmin')->name('pengaturan-akun.tambah-admin');
    Route::post('/ganti-password', 'changePassword')->name('pengaturan-akun.changePassword');
    Route::put('/update/photo/{id}', 'changePhoto')->name('pengaturan-akun.update-profile');
});

Route::controller(WithdrawalController::class)->prefix('/admin/manajemen-withdrawal')->middleware([])->group(function(){
    Route::get("/", "index")->name("manajemen-withdrawal");
    Route::put("/update/{id}", "update")->name("manajemen-withdrawal.update");
});

Route::controller(CategoryController::class)->prefix("/admin/manajemen-kategori")->group(function(){
    Route::get('/', 'index')->name('manajemen-kategori');
    Route::post("/store", "store")->name("manajemen-kategori.store");
    Route::post("/update/{id}", "update")->name("manajemen-kategori.update");
    Route::delete("/delete/{id}", "delete")->name("manajemen-kategori.delete");
});

Route::controller(AccountController::class)->prefix("/admin/account")->group(function(){
    Route::get("/", "index")->name("account.index");
    Route::post("/suspend", "suspend")->name("account.suspend");
    Route::get("/search", "search")->name("account.search");
});

Route::controller(ProductController::class)->prefix("/admin/product")->group(function () {
    Route::get("/update/{id}", "index")->name("product.index");
    Route::get("/", "index")->name("product.index");
    Route::get("/trash", "trash")->name("product.trash");
    Route::delete("/delete/{id}", "delete")->name("product.delete");
    Route::put("/restore/{id}", "restore")->name("product.restore");
    Route::get("/search", "search")->name("product.search");
});


require __DIR__ . '/auth.php';
