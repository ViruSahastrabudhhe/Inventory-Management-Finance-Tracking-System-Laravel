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
use App\Http\Controllers\Supplier\SupplierController;
use App\Http\Controllers\Purchase\PurchaseController;
use App\Http\Controllers\Sales\SalesController;

Route::get('/', function () {
    return view('auth.landing');
})->name('landing');        

Route::controller(DashboardController::class)->group(function (){
    Route::get('/manager/dashboard', 'showManagerDashboard')->middleware(['auth', 'manager'])->name('view-dashboard');
    Route::get('/admin/dashboard', 'showAdminDashboard')->middleware(['auth', 'admin'])->name('view-admin-dashboard');
});

Route::controller(BusinessController::class)->group(function () {
    Route::get('manager/business/create','index')->middleware('auth')->name('view-create-business');
    Route::post('manager/business/create','store')->middleware('auth')->name('business.register');
});

Route::controller(SupplierController::class)->group(function () {
    Route::get('manager/purchases/suppliers','index')->middleware(['auth', 'manager', 'business', 'verified'])->name('view-suppliers');
    Route::get('manager/purchases/suppliers/create','create')->middleware(['auth', 'manager', 'business', 'verified'])->name('view-add-supplier');
    Route::get('manager/purchases/suppliers/{supplier}/edit','edit')->middleware(['auth', 'manager', 'business', 'verified'])->name('view-edit-supplier');
    Route::post('manager/purchases/suppliers/create','store')->middleware(['auth', 'manager', 'business', 'verified'])->name('supplier.add');
    Route::post('manager/purchases/suppliers/{supplier}/edit','update')->middleware(['auth', 'manager', 'business', 'verified'])->name('supplier.update');
    Route::post('manager/purchases/suppliers/{supplier}/delete','destroy')->middleware(['auth', 'manager', 'business', 'verified'])->name('supplier.destroy');
});

Route::controller(CategoryController::class)->group(function (){
    Route::get('/manager/items/categories','index')->middleware(['auth', 'manager', 'business', 'verified'])->name('view-categories');
    Route::get('/manager/items/categories/create','create')->middleware(['auth', 'manager', 'business', 'verified'])->name('view-add-category');
    Route::post('/manager/items/categories/create', 'store')->middleware(['auth', 'manager', 'business', 'verified'])->name('category.add');
});
Route::controller(PurchaseController::class)->group(callback: function (){
    Route::get('/manager/purchases', 'index')->middleware(['auth', 'manager', 'business', 'verified'])->name('view-purchases');
    Route::get('/manager/purchases/purchase/{purchase}', 'show')->middleware(['auth', 'manager', 'business', 'verified'])->name('view-purchase-info');
    Route::get('/manager/purchases/create', 'create')->middleware(['auth', 'manager', 'business', 'verified'])->name('view-add-purchases');
    Route::post('/manager/purchases/create', 'store')->middleware(['auth', 'manager', 'business', 'verified'])->name('purchase.add');
});
Route::controller(SalesController::class)->group(function (){
    Route::get('/manager/sales', 'index')->middleware(['auth', 'manager', 'business', 'verified'])->name('view-sales');
});

Route::controller(ProductController::class)->group(function (){
    Route::get('/manager/items', 'index')->middleware(['auth', 'manager', 'business', 'verified'])->name('view-products');
    Route::get('/manager/items/create', 'create')->middleware(['auth', 'manager', 'business', 'verified'])->name('view-add-product');
    Route::get('/manager/items/item/{product}', 'show')->middleware(['auth', 'manager', 'business', 'verified'])->name('view-product-info');
    Route::post('/manager/items/create', 'store')->middleware(['auth', 'manager', 'business', 'verified'])->name('product.add');
    Route::get('/manager/items/item/{product}/edit', 'edit')->middleware(['auth', 'manager', 'business', 'verified'])->name('view-edit-product');
    Route::post('/manager/items/item/{product}/edit', 'update')->middleware(['auth', 'manager', 'business', 'verified'])->name('product.update');
    Route::post('/manager/items/item/{product}/delete', 'destroy')->middleware(['auth', 'manager', 'business', 'verified'])->name('product.destroy');
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