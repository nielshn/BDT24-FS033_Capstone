<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontController::class, 'index'])->name('front.home');
Route::get('category', [FrontController::class, 'category'])->name('front.category');
Route::get('details', [FrontController::class, 'details'])->name('front.details');
Route::get('cart', [FrontController::class, 'cart'])->name('front.cart');
Route::get('success', [FrontController::class, 'success'])->name('front.success');
Route::get('register-success', [FrontController::class, 'registerSuccess'])->name('front.registerSuccess');
Route::resource('products', ProductController::class);
Route::resource('transactions', TransactionController::class);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('store-settings', [DashboardController::class, 'storeSettings'])->name('dashboard.storeSettings');
Route::get('account-settings', [DashboardController::class, 'accountSettings'])->name('dashboard.accountSettings');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('categories', CategoryController::class)->middleware('role:admin');
    });
});

require __DIR__ . '/auth.php';
