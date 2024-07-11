<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PaymentMethodController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('customers', CustomerController::class);

Route::resource('payment_methods', PaymentMethodController::class);

Route::resource('menus', MenuController::class);

Route::resource('orders', OrderController::class);

// Route::get('/payment_methods', [PaymentMethodController::class, 'index'])->name('payment_methods.index');
