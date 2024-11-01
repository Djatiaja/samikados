<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\VerifyMustHaveEmail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
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

Route::controller(CategoryController::class)->group(function(){
    Route::get('/admin/category', 'index')->name("category.index");
    Route::get('/admin/category/create','create');
    Route::post("/admin/category/store", "store")->name("category.store");
});

Route::middleware(["auth", "verified"])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
