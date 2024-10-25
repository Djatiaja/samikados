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
