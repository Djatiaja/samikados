<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\VerifyMustHaveEmail;
use App\Http\Middleware\VerifyRole;
use App\Models\Product;
use App\Models\Product_finishing;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    dd(true);
    return view('welcome');
});

Route::get('/login-fe', function () {
    return view('login-fe');
})->name('login-fe');

Route::get('/forgot-password-fe', function () {
    return view('forgot-password-fe');
})->name('forgot-password-fe');

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
Route::view('/admin/mapproval-withdraw-fe', 'approval-withdraw-fe')->name('approval-withdraw-fe');
Route::view('/admin/laporan-fe', 'laporan-fe')->name('laporan-fe');
Route::view('/admin/notifikasi-fe', 'notifikasi-fe')->name('notifikasi-fe');
Route::view('/admin/pengaturan-akun-fe', 'pengaturan-akun-fe')->name('pengaturan-akun-fe'); 
Route::view('/admin/kategori-fe', 'kategori-fe')->name('kategori-fe');
Route::view('/admin/produk-fe', 'produk-fe')->name('produk-fe');
Route::view('/admin/detail-produk-fe', 'detail-produk-fe')->name('detail-produk-fe');
// 
Route::controller(CategoryController::class)->group(function(){
    Route::get('/admin/category', 'index')->name("category.index");
    Route::get('/admin/category/create','create');
    Route::post("/admin/category/store", "store")->name("category.store");
    Route::post("/admin/category/update/save/{id}", "update")->name("category.update");
    Route::get("/admin/category/update/{id}", "edit")->name("category.edit");
    Route::get("/admin/category/delete/{id}", "delete")->name("category.delete");
});

Route::middleware(["auth", "verified", "role:admin"])->group(function ()   {
    Route::get('/dashboard', function () {
        return view('dashboard');    })->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

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
