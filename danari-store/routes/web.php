<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.home');
});


Route::view('category', 'frontend.category');
Route::view('product-details', 'frontend.product-details');
Route::view('cart', 'frontend.cart');
Route::view('success', 'frontend.success');
Route::view('register-success', 'auth.register-success');


Route::view('dashboard-admin', 'backend.dashboard');
Route::view('my-products', 'backend.products.index');
Route::view('product-details', 'backend.products.show');
Route::view('create-product', 'backend.products.create');
Route::view('transactions', 'backend.transactions.index');
Route::view('transaction-details', 'backend.transactions.show');
Route::view('store-settings', 'backend.store-settings');
Route::view('account-settings', 'auth.account-settings');


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
