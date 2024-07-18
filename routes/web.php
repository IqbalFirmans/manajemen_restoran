<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\TableController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('reset1', function () {
//     return view('auth.passwords.email1');
// });

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('customers', CustomerController::class);

    Route::resource('payment_methods', PaymentMethodController::class);

    Route::resource('menus', MenuController::class);

    Route::resource('orders', OrderController::class);

    Route::resource('categories', CategoryController::class);

    Route::resource('tables', TableController::class);
});
