<?php

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