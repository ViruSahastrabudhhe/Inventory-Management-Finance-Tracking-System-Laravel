<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Business\BusinessController;

Route::get('/', function () {
    return view('auth.landing');
})->name('landing');        

Route::controller(DashboardController::class)->group(function (){
    Route::get('/manager/dashboard', 'showManagerDashboard')->middleware(['auth', 'manager'])->name('view-dashboard');
    Route::get('/admin/dashboard', 'showAdminDashboard')->middleware(['auth', 'admin'])->name('view-admin-dashboard');
});

Route::controller(BusinessController::class)->group(function () {
    Route::get('manager/create/business','index')->middleware('auth')->name('view-create-business');
    Route::post('manager/create/business','store')->middleware('auth')->name('business.register');
});

Route::controller(CategoryController::class)->group(function (){
    Route::post('/manager/add-product-category', 'store')->middleware(['auth', 'verified', 'manager'])->name('category.add');
});

Route::controller(ProductController::class)->group(function (){
    Route::get('/manager/add-product', 'viewAddProduct')->middleware(['auth', 'verified', 'manager'])->name('view-add-product');
    Route::post('/manager/add-product', 'store')->middleware(['auth', 'verified', 'manager'])->name('product.add');
    Route::get('/manager/edit-product/{product}', 'edit')->middleware(['auth', 'verified', 'manager'])->name('view-edit-product');
    Route::post('/manager/update-product/{product}', 'update')->middleware(['auth', 'verified', 'manager'])->name('product.update');
    Route::post('/manager/delete-product/{product}', 'destroy')->middleware(['auth', 'verified', 'manager'])->name('product.destroy');
});
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('view-login');
    Route::post('/login', 'login')->name('auth.login');
    Route::post('/logout', 'logout')->name('auth.logout');
});
Route::controller(RegisterController::class)->group(function () {
    Route::get('/auth/sign-up', 'index')->name('view-register');
    Route::post('/auth/register', 'store')->name('auth.register');
});
Route::controller(PasswordController::class)->group(function () {
    Route::get('/auth/forgot-password', 'viewForgotPass')->name('password.request');
    Route::post('/auth/forgot-password', 'notify')->name('password.email');
    Route::get('/auth/change-password/{token}', 'viewResetPass')->name('password.reset');
    Route::post('/auth/reset-password', 'update')->name('password.update');
});
Route::controller(EmailVerificationController::class)->group(function () {
    Route::get('/verify-email', 'index')->middleware('auth')->name('verification.notice');
    Route::get('/verify-email/{id}/{hash}', 'verify')->middleware('auth', 'signed')->name('verification.verify');
    Route::post('/verify-email/verification-notification', 'notify')->middleware('auth', 'throttle:6,1')->name('verification.send');
});