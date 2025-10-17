<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::resource('menu', App\Http\Controllers\MenuItemController::class);
Route::resource('customers', App\Http\Controllers\CustomerController::class)->except(['show']);
Route::resource('orders', App\Http\Controllers\OrderController::class);
Route::get('transactions', [App\Http\Controllers\TransactionController::class, 'index'])->name('transactions.index');
Route::get('transactions/{order}', [App\Http\Controllers\TransactionController::class, 'show'])->name('transactions.show');

