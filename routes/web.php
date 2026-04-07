<?php

use App\Livewire\Auth\Register;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginUserController;
use App\Http\Controllers\Frontend\NavigasiMenuController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\ChangePasswordUserController;
use App\Http\Controllers\Auth\ForgotPasswordUserController;
use App\Http\Controllers\Customer\CheckShippingCostController;
use App\Http\Controllers\Frontend\OrderConfirmedController;
use App\Http\Controllers\Customer\CustomerAddressController;
use App\Http\Controllers\Customer\CustomerProfileController;
use App\Http\Controllers\Customer\OrderHistory;

Route::get('/',[NavigasiMenuController::class, 'home'])->name('home');
Route::get('/products', [NavigasiMenuController::class, 'products'])->name('product.catalog');
Route::get('/product/{product:slug}', [NavigasiMenuController::class, 'productDetails'])->name('product.details');
Route::get('/carts', [NavigasiMenuController::class, 'carts'])->name('product.carts');
Route::get('/checkout', [NavigasiMenuController::class, 'checkout'])->name('checkout');
Route::webhooks('moota/callback');



Route::middleware('guest')->group(function() {
    Route::get('/register', Register::class)->name('register');
    Route::get('/login', [LoginUserController::class, 'index'])->name('login');
    Route::get('/email/verify', [EmailVerificationController::class, 'verification'])->middleware('guest.verification')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
    Route::get('/email/verified', [EmailVerificationController::class, 'showPageVerifiedEmail'])->name('verification.verified');
    Route::get('/reset-password/{token}', [ForgotPasswordUserController::class,'resetPassword'])->name('password.reset');
    Route::get('/forgot-password', [ForgotPasswordUserController::class, 'index'])->name('password.request');
});
    
Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('/logout', [LoginUserController::class, 'logout'])->name('logout.customer');
    Route::get('/profile-customer', [CustomerProfileController::class, 'index'])->name('customer.profile');
    Route::post('/upload-avatar',[CustomerProfileController::class, 'uploadAvatar'])->name('upload.avatar');
    Route::delete('/cancel-upload-avatar',[CustomerProfileController::class, 'cancelUploadAvatar'])->name('cancel.upload.avatar');
    Route::get('/customer-address', [CustomerAddressController::class, 'index'])->name('customer.address');
    Route::get('/change-password', [ChangePasswordUserController::class, 'index'])->name('change.password.user');

    Route::get('/cek-ongkir', [CheckShippingCostController::class, 'index'])->name('check.ongkir');
    Route::get('/order-confirmed/{sales_order:trx_id}', [OrderConfirmedController::class, 'index'])->name('order.confirmed');
    Route::get('/order-history', [OrderHistory::class, 'index'])->name('order.history');
});
