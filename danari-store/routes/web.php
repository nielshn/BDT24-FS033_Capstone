<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// User Routes
Route::view('/', 'frontend.home');
Route::view('categories', 'frontend.category');
Route::view('details', 'frontend.product-details');
Route::view('cart', 'frontend.cart');
Route::view('success', 'frontend.success');
Route::view('my-dashboard', 'dashboard');
Route::view('my-products', 'frontend.products.index');
Route::view('product-details', 'frontend.products.show');
Route::view('create-product', 'frontend.products.create');
Route::view('transactions', 'frontend.transactions.index');
Route::view('transaction-details', 'frontend.transactions.show');
Route::view('store-settings', 'frontend.store-settings');

Route::view('register-success', 'auth.register-success');
Route::view('account-settings', 'auth.account-settings');

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Route::view('dashboard', '')
});


Route::get(
    '/dashboard',
    function () {
        return view('backend.dashboard');
    }
)->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
