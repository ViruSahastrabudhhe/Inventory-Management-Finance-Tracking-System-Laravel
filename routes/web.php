<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Business\BusinessController;

Route::get('/', function () {
    return view('auth.landing');
})->name('landing');        

Route::controller(DashboardController::class)->group(function (){
    Route::get('/manager/dashboard', 'showManagerDashboard')->middleware('auth')->name('view-dashboard');
    Route::get('/admin/dashboard', 'showAdminDashboard')->middleware(['auth', 'admin'])->name('view-admin-dashboard');
});

Route::controller(BusinessController::class)->group(function () {
    Route::get('manager/create/business','index')->middleware('auth')->name('view-create-business');
    Route::post('manager/create/business','store')->middleware('auth')->name('business.register');
});

Route::controller(ProductController::class)->group(function (){
    Route::get('/add-product', 'viewAddProduct')->middleware(['auth', 'verified'])->name('view-add-product');
    Route::post('/add-product', 'store')->middleware(['auth', 'verified'])->name('product.add');
    Route::get('/edit-product/{product}', 'edit')->middleware(['auth', 'verified'])->name('view-edit-product');
    Route::post('/update-product/{product}', 'update')->middleware(['auth', 'verified'])->name('product.update');
    Route::post('/delete-product/{product}', 'destroy')->middleware(['auth', 'verified'])->name('product.destroy');
});
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('view-login');
    Route::post('/login', 'login')->name('auth.login');
    Route::post('/logout', 'logout')->name('auth.logout');
});
Route::controller(RegisterController::class)->group(function () {
    Route::get('/sign-up', 'index')->name('view-register');
    Route::post('/register', 'store')->name('auth.register');
});
Route::controller(PasswordController::class)->group(function () {
    Route::get('/forgot-password', 'viewForgotPass')->middleware('guest')->name('password.request');
    Route::post('/forgot-password', 'notify')->middleware('guest')->name('password.email');
    Route::get('/change-password/{token}', 'viewResetPass')->middleware('guest')->name('password.reset');
    Route::post('/reset-password', 'update')->middleware('guest')->name('password.update');
});
Route::controller(EmailVerificationController::class)->group(function () {
    Route::get('/verify-email', 'index')->middleware('auth')->name('verification.notice');
    Route::get('/verify-email/{id}/{hash}', 'verify')->middleware('auth', 'signed')->name('verification.verify');
    Route::post('/verify-email/verification-notification', 'notify')->middleware('auth', 'throttle:6,1')->name('verification.send');
});