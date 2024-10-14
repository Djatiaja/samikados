<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProviderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

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

require __DIR__.'/auth.php';
