<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    return view('auth.landing');
})->name('landing');

Route::view('/login', 'auth.login')->name('view-login');
Route::view('/register', 'auth.register')->name('view-register');
Route::view('/dashboard', 'home.dashboard')->name('view-dashboard');

Route::controller(LoginController::class)->group(function () {
    Route::post('/login', 'login')->name('auth-login');
    Route::post('/logout', 'logout')->name('auth-logout');
});
Route::post('/register', RegisterController::class)->name('auth-register');