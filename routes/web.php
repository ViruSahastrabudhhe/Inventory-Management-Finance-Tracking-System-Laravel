<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\PasswordController;

Route::get('/', function () {
    return view('auth.landing');
})->name('landing');

Route::view('/dashboard', 'home.dashboard')->middleware('auth')->name('view-dashboard');

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('view-login');
    Route::post('/login', 'login')->name('auth-login');
    Route::post('/logout', 'logout')->name('auth-logout');
});
Route::controller(RegisterController::class)->group(function () {
    Route::get('/sign-up', 'index')->middleware('guest')->name('view-register');
    Route::post('/register', 'store')->middleware('guest')->name('auth-register');
});
Route::controller(PasswordController::class)->group(function () {
    Route::get('/request-password-reset', 'viewForgotPass')->middleware('guest')->name('password.request');
    Route::post('/forgot-password', 'sendForgotPasswordRequest')->middleware('guest')->name('password.email');
    Route::get('/change-password/{email}/{token}', 'viewResetPass')->middleware('guest')->name('password.reset');
    Route::post('/reset-password', 'updatePassword')->middleware('guest')->name('password.update');
});