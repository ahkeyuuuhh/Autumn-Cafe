<?php

use Illuminate\Support\Facades\Route;

// Authentication Routes
Route::get('/register', [App\Http\Controllers\AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

// Redirect root to login if not authenticated, otherwise to dashboard
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

// Protected Routes (require authentication)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::resource('menu', App\Http\Controllers\MenuItemController::class);
    Route::resource('customers', App\Http\Controllers\CustomerController::class)->except(['show']);
    Route::resource('orders', App\Http\Controllers\OrderController::class);
    
    // Transaction routes
    Route::get('transactions', [App\Http\Controllers\TransactionController::class, 'index'])->name('transactions.index');
    Route::get('transactions/{order}', [App\Http\Controllers\TransactionController::class, 'show'])->name('transactions.show');
    Route::patch('transactions/{order}/status', [App\Http\Controllers\TransactionController::class, 'updateStatus'])->name('transactions.update-status');
});

