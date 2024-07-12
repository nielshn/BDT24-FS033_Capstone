<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductGaleryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreSettingsController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontController::class, 'index'])->name('front.home');
Route::get('category/{category:slug}', [FrontController::class, 'detailCategory'])->name('front.category');
Route::get('all-products', [FrontController::class, 'allProducts'])->name('front.products');
Route::get('detail-products/{product:slug}', [FrontController::class, 'detailProducts'])->name('front.details');

Route::post('checkout', [CheckoutController::class, 'process'])->name('checkout');
Route::post('checkout/callback', [CheckoutController::class, 'callback'])->name('midtrans-callback');

Route::get('success', [FrontController::class, 'success'])->name('front.success');
Route::get('register-success', [FrontController::class, 'registerSuccess'])->name('front.registerSuccess');

Route::get('register/check', [RegisteredUserController::class, 'check'])->name('api-register-check');
Route::get('provinces', [LocationController::class, 'provinces'])->name('api-provinces');
Route::get('regencies/{provinces_id}', [LocationController::class, 'regencies'])->name('api-regencies');


Route::get('dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('account-settings', [DashboardController::class, 'accountSettings'])->name('dashboard.accountSettings');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::resource('products', ProductController::class)->middleware('role:seller|admin');
    Route::resource('product-galleries', ProductGaleryController::class)->only(['store']);
    Route::get('products/gallery/delete/{productGalery:id}', [ProductGaleryController::class, 'destroy'])
        ->name('product-galleries.delete');

    Route::resource('store-settings', StoreSettingsController::class)->middleware('role:seller');

    Route::resource('cart-products', CartController::class)->middleware('role:customer|seller')->only(['index', 'store', 'destroy']);
    Route::patch('/cart-products/{id}/update-quantity', [CartController::class, 'updateQuantity'])->name('cart-products.updateQuantity');
    // Route::put('/cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');


    Route::resource('transactions', TransactionController::class);

    Route::prefix('admin')->name('admin.')->group(function () {
        $adminRole = 'role:admin';
        Route::resource('categories', CategoryController::class)->middleware($adminRole);
        Route::get('products', [DashboardController::class, 'allProducts'])->name('allproducts.index')->middleware($adminRole);
        Route::get('products/{product:slug}', [DashboardController::class, 'showProduct'])->name('allproducts.show')->middleware($adminRole);
        Route::get('users', [DashboardController::class, 'allUsers'])->name('users.index')->middleware($adminRole);
    });
});

require __DIR__ . '/auth.php';
