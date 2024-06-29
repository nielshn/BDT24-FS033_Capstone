<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// User Routes
Route::view('/', 'frontend.home')->name('home');
Route::view('categories', 'frontend.category');
Route::view('details', 'frontend.product-details');
Route::view('cart', 'frontend.cart');
Route::view('success', 'frontend.success');
Route::view('my-dashboard', 'das@hboard');
Route::view('my-products', 'frontend.products.index');
Route::view('product-details', 'frontend.products.show');
Route::view('create-product', 'frontend.products.create');
Route::view('transactions', 'frontend.transactions.index');
Route::view('transaction-details', 'frontend.transactions.show');
Route::view('store-settings', 'frontend.store-settings');

Route::view('register-success', 'auth.register-success');
Route::view('account-settings', 'auth.account-settings');



Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('categories', CategoryController::class);
    });
});

require __DIR__ . '/auth.php';
