<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductGaleryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreSettingsController;
use App\Http\Controllers\TransactionController;
use App\Models\ProductGalery;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontController::class, 'index'])->name('front.home');
Route::get('category', [FrontController::class, 'category'])->name('front.category');
Route::get('details', [FrontController::class, 'details'])->name('front.details');
Route::get('cart', [FrontController::class, 'cart'])->name('front.cart');
Route::get('success', [FrontController::class, 'success'])->name('front.success');
Route::get('register-success', [FrontController::class, 'registerSuccess'])->name('front.registerSuccess');
Route::get('register/check', [RegisteredUserController::class, 'check'])->name('api-register-check');


Route::resource('transactions', TransactionController::class);

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

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('categories', CategoryController::class)->middleware('role:admin');
        Route::get('all-products', [DashboardController::class, 'allProducts'])->name('allproducts.index')->middleware('role:admin');
    });
});

require __DIR__ . '/auth.php';
