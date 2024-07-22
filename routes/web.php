<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\TableController;


Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('customers', CustomerController::class);

    Route::resource('payment_methods', PaymentMethodController::class);

    Route::get('menus/deleted', [MenuController::class, 'showDeleted'])->name('menus.deleted');
    Route::post('menus/restore/{id}', [MenuController::class, 'restore'])->name('menus.restore');
    Route::delete('menus/force-delete/{id}', [MenuController::class, 'forceDelete'])->name('menus.forceDelete');
    Route::resource('menus', MenuController::class);

    Route::get('/orders/history', [OrderController::class, 'history'])->name('orders.history');
    Route::put('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
    Route::put('/orders/{order}/accept', [OrderController::class, 'accept'])->name('orders.accept');
    Route::resource('orders', OrderController::class);

    Route::resource('categories', CategoryController::class);

    Route::resource('tables', TableController::class);
});
