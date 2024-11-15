<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\VerifyMustHaveEmail;
use App\Http\Middleware\VerifyRole;
use App\Models\Product;
use App\Models\Product_finishing;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\EventListener\ProfilerListener;

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
Route::view('/admin/mapproval-withdraw-fe', 'approval-withdraw-fe')->name('approval-withdraw-fe');
Route::view('/admin/laporan-fe', 'laporan-fe')->name('laporan-fe');
Route::view('/admin/notifikasi-fe', 'notifikasi-fe')->name('notifikasi-fe');
Route::view('/admin/kategori-fe', 'kategori-fe')->name('kategori-fe');
Route::view('/admin/produk-fe', 'produk-fe')->name('produk-fe');
Route::view('/admin/detail-produk-fe', 'detail-produk-fe')->name('detail-produk-fe');
// 

Route::controller(AdminController::class)->prefix("/admin")->group(function(){
    Route::get("/", "index")->name("dashboard");
    Route::view('/pengaturan-akun', 'admin.pengaturan-akun')->name('pengaturan-akun'); 
});

// Route::controller(ProfileController::class)


Route::controller(CategoryController::class)->prefix("/admin/manajemen-kategori")->group(function(){
    Route::get('/', 'index')->name('manajemen-kategori');
    Route::post("/store", "store")->name("manajemen-kategori.store");
    Route::post("/update/{id}", "update")->name("manajemen-kategori.update");
    Route::delete("/delete/{id}", "delete")->name("manajemen-kategori.delete");
});

Route::middleware(["auth", "verified", "role:admin"])->group(function ()   {
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
