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
use App\Http\Controllers\Sales\SalesDetailController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\PurchaseDetail\PurchaseDetailController;

Route::get('/', function () {
    return view('auth.landing');
})->name('landing');        

Route::controller(DashboardController::class)->group(function (){
    Route::get('/manager/dashboard', 'showManagerDashboard')->middleware(['auth', 'manager'])->name('view-dashboard');
    Route::get('/admin/dashboard', 'showAdminDashboard')->middleware(['auth', 'admin'])->name('view-admin-dashboard');
});

Route::controller(AdminController::class)->group(function (){
    Route::get('/admin/users','index')->middleware(['auth', 'admin', 'verified'])->name('view-users');
    Route::post('/admin/users/user/{userID}/activate','activate')->middleware(['auth', 'admin', 'verified'])->name('admin.activate');
});

Route::controller(BusinessController::class)->group(function () {
    Route::get('/manager/business/create','index')->middleware('auth')->name('view-create-business');
    Route::post('/manager/business/create','store')->middleware('auth')->name('business.register');
});

Route::controller(SupplierController::class)->group(function () {
    Route::get('/manager/purchases/suppliers','index')->middleware(['auth', 'manager', 'business', 'verified'])->name('view-suppliers');
    Route::get('/manager/purchases/suppliers/create','create')->middleware(['auth', 'manager', 'business', 'verified'])->name('view-add-supplier');
    Route::get('/manager/purchases/suppliers/{supplier}/edit','edit')->middleware(['auth', 'manager', 'business', 'verified'])->name('view-edit-supplier');
    Route::post('/manager/purchases/suppliers/create','store')->middleware(['auth', 'manager', 'business', 'verified'])->name('supplier.add');
    Route::post('/manager/purchases/suppliers/{supplier}/edit','update')->middleware(['auth', 'manager', 'business', 'verified'])->name('supplier.update');
    Route::post('/manager/purchases/suppliers/{supplier}/delete','destroy')->middleware(['auth', 'manager', 'business', 'verified'])->name('supplier.destroy');
});

Route::controller(CustomerController::class)->group(function () {
    Route::get('/manager/sales/customers','index')->middleware(['auth', 'manager', 'business', 'verified'])->name('view-customers');
    Route::get('/manager/sales/customers/create','create')->middleware(['auth', 'manager', 'business', 'verified'])->name('view-add-customer');
    Route::get('/manager/sales/customers/customer/{customer}/edit','edit')->middleware(['auth', 'manager', 'business', 'verified'])->name('view-edit-customer');
    Route::post('/manager/sales/customers/create','store')->middleware(['auth', 'manager', 'business', 'verified'])->name('customer.add');
    Route::post('/manager/sales/customers/customer/{customer}/edit','update')->middleware(['auth', 'manager', 'business', 'verified'])->name('customer.update');
    Route::post('/manager/sales/customers/customer/{customer}/delete','destroy')->middleware(['auth', 'manager', 'business', 'verified'])->name('customer.destroy');
});

Route::controller(CategoryController::class)->group(function (){
    Route::get('/manager/items/categories','index')->middleware(['auth', 'manager', 'business', 'verified'])->name('view-categories');
    Route::get('/manager/items/categories/create','create')->middleware(['auth', 'manager', 'business', 'verified'])->name('view-add-category');
    Route::get('/manager/items/categories/category/{category}/edit','edit')->middleware(['auth', 'manager', 'business', 'verified'])->name('view-edit-category');
    Route::post('/manager/items/categories/create', 'store')->middleware(['auth', 'manager', 'business', 'verified'])->name('category.add');
    Route::post('/manager/items/categories/category/{category}/edit', 'update')->middleware(['auth', 'manager', 'business', 'verified'])->name('category.update');
    Route::post('/manager/items/categories/category/{category}/delete', 'destroy')->middleware(['auth', 'manager', 'business', 'verified'])->name('category.destroy');
});
Route::controller(PurchaseDetailController::class)->group(callback: function (){
    Route::get('/manager/purchases/details/detail/{product}/create', 'create')->middleware(['auth', 'manager', 'business', 'verified'])->name('view-add-purchase-detail');
    Route::get('/manager/purchases/details/detail/{product}/edit', 'edit')->middleware(['auth', 'manager', 'business', 'verified'])->name('view-edit-purchase-detail');
    Route::post('/manager/purchases/details/detail/{product}/create', 'store')->middleware(['auth', 'manager', 'business', 'verified'])->name('purchase_detail.add');
    Route::post('/manager/purchases/details/detail/{purchase_detail}/delete', 'destroy')->middleware(['auth', 'manager', 'business', 'verified'])->name('purchase_detail.destroy');
    Route::post('/manager/purchases/details/detail/{product}/edit', 'update')->middleware(['auth', 'manager', 'business', 'verified'])->name('purchase_detail.update');
    Route::post('/manager/purchases/details/detail/{product}/{purchase_detail}/restock', 'receive')->middleware(['auth', 'manager', 'business', 'verified'])->name('purchase_detail.restock');
});

Route::controller(PurchaseController::class)->group(callback: function (){
    Route::get('/manager/purchases', 'index')->middleware(['auth', 'manager', 'business', 'verified'])->name('view-purchases');
    Route::get('/manager/purchases/purchase/{purchase}', 'show')->middleware(['auth', 'manager', 'business', 'verified'])->name('view-purchase-info');
    Route::get('/manager/purchases/purchase/{purchase}/redirect', 'goto')->middleware(['auth', 'manager', 'business', 'verified'])->name('goto-purchase-info');
    Route::get('/manager/purchases/create', 'create')->middleware(['auth', 'manager', 'business', 'verified'])->name('view-add-purchase');
    Route::get('/manager/purchases/purchase/{purchase}/edit', 'edit')->middleware(['auth', 'manager', 'business', 'verified'])->name('view-edit-purchase');
    Route::post('/manager/purchases/create', 'store')->middleware(['auth', 'manager', 'business', 'verified'])->name('purchase.add');
    Route::post('/manager/purchases/purchase/{purchase}/issue', 'issue')->middleware(['auth', 'manager', 'business', 'verified'])->name('purchase.issue');
    Route::post('/manager/purchases/purchase/{purchase}/complete', 'complete')->middleware(['auth', 'manager', 'business', 'verified'])->name('purchase.complete');
    Route::post('/manager/purchases/purchase/{purchase}/edit', 'update')->middleware(['auth', 'manager', 'business', 'verified'])->name('purchase.update');
    Route::post('/manager/purchases/purchase/{purchase}/delete', 'destroy')->middleware(['auth', 'manager', 'business', 'verified'])->name('purchase.destroy');
});
Route::controller(SalesController::class)->group(function (){
    Route::get('/manager/sales', 'index')->middleware(['auth', 'manager', 'business', 'verified'])->name('view-sales');
    Route::get('/manager/sales/create', 'create')->middleware(['auth', 'manager', 'business', 'verified'])->name('view-add-sale');
    Route::get('/manager/sales/sale/{sales}/edit', 'edit')->middleware(['auth', 'manager', 'business', 'verified'])->name('view-edit-sale');
    Route::get('/manager/sales/sale/{sales}', 'show')->middleware(['auth', 'manager', 'business', 'verified'])->name('view-sales-info');
    Route::post('/manager/sales/create', 'store')->middleware(['auth', 'manager', 'business', 'verified'])->name('sales.add');
    Route::post('/manager/sales/sale/{sales}/edit', 'update')->middleware(['auth', 'manager', 'business', 'verified'])->name('sales.update');
    Route::post('/manager/sales/sale/{sales}/issue', 'issue')->middleware(['auth', 'manager', 'business', 'verified'])->name('sales.issue');
    Route::post('/manager/sales/sale/{sales}/ship', 'ship')->middleware(['auth', 'manager', 'business', 'verified'])->name('sales.ship');
    Route::post('/manager/sales/sale/{sales}/deliver', 'deliver')->middleware(['auth', 'manager', 'business', 'verified'])->name('sales.deliver');
    Route::post('/manager/sales/sale/{sales}/complete', 'complete')->middleware(['auth', 'manager', 'business', 'verified'])->name('sales.complete');
    Route::post('/manager/sales/sale/{sales}/delete', 'destroy')->middleware(['auth', 'manager', 'business', 'verified'])->name('sales.destroy');
});

Route::controller(SalesDetailController::class)->group(function () {
    Route::get('/manager/sales/details/detail/{product}/create','create')->middleware(['auth', 'manager', 'business', 'verified'])->name('view-add-sales-detail');
    Route::post('/manager/sales/details/detail/{product}/create','store')->middleware(['auth', 'manager', 'business', 'verified'])->name('sales_detail.add');
    Route::post('/manager/sales/details/detail/{order_detail}/delete','destroy')->middleware(['auth', 'manager', 'business', 'verified'])->name('sales_detail.destroy');
    Route::post('/manager/sales/details/detail/{product}/{order_detail}/restock', 'deliver')->middleware(['auth', 'manager', 'business', 'verified'])->name('sales_detail.destock');
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