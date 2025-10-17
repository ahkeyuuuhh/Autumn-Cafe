<?php

use Illuminate\Support\Facades\Route;

// Admin Authentication Routes
Route::get('/admin/register', [App\Http\Controllers\AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/admin/register', [App\Http\Controllers\AuthController::class, 'register']);
Route::get('/admin/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('/admin/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

// Customer Authentication Routes
Route::get('/customer/register', [App\Http\Controllers\CustomerAuthController::class, 'showRegisterForm'])->name('customer.register');
Route::post('/customer/register', [App\Http\Controllers\CustomerAuthController::class, 'register']);
Route::get('/customer/login', [App\Http\Controllers\CustomerAuthController::class, 'showLoginForm'])->name('customer.login');
Route::post('/customer/login', [App\Http\Controllers\CustomerAuthController::class, 'login']);
Route::post('/customer/logout', [App\Http\Controllers\CustomerAuthController::class, 'logout'])->name('customer.logout');

// Cashier Authentication Routes
Route::get('/cashier/register', [App\Http\Controllers\CashierAuthController::class, 'showRegister'])->name('cashier.register');
Route::post('/cashier/register', [App\Http\Controllers\CashierAuthController::class, 'register']);
Route::get('/cashier/login', [App\Http\Controllers\CashierAuthController::class, 'showLogin'])->name('cashier.login');
Route::post('/cashier/login', [App\Http\Controllers\CashierAuthController::class, 'login']);
Route::post('/cashier/logout', [App\Http\Controllers\CashierAuthController::class, 'logout'])->name('cashier.logout');

// Cashier Protected Routes
Route::middleware(['web'])->group(function () {
    Route::get('/cashier/dashboard', [App\Http\Controllers\CashierDashboardController::class, 'index'])->name('cashier.dashboard');
    Route::post('/cashier/order/{id}/status', [App\Http\Controllers\CashierDashboardController::class, 'updateOrderStatus'])->name('cashier.order.status');
    Route::get('/cashier/order/create', [App\Http\Controllers\CashierDashboardController::class, 'createOrder'])->name('cashier.order.create');
    Route::post('/cashier/order/store', [App\Http\Controllers\CashierDashboardController::class, 'storeOrder'])->name('cashier.order.store');
});

// Customer Public Routes
Route::get('/', [App\Http\Controllers\CustomerMenuController::class, 'index'])->name('customer.menu');
Route::post('/cart/add', [App\Http\Controllers\CustomerMenuController::class, 'addToCart'])->name('cart.add');

// Customer Protected Routes (require customer login)
Route::middleware(['web'])->group(function () {
    Route::get('/cart', [App\Http\Controllers\CustomerMenuController::class, 'showCart'])->name('customer.cart');
    Route::post('/cart/update', [App\Http\Controllers\CustomerMenuController::class, 'updateCart'])->name('cart.update');
    Route::delete('/cart/remove/{menuItemId}', [App\Http\Controllers\CustomerMenuController::class, 'removeFromCart'])->name('cart.remove');
    Route::delete('/cart/clear', [App\Http\Controllers\CustomerMenuController::class, 'clearCart'])->name('cart.clear');
    Route::post('/checkout', [App\Http\Controllers\CustomerMenuController::class, 'checkout'])->name('customer.checkout');
    Route::get('/order/confirmation/{orderId}', [App\Http\Controllers\CustomerMenuController::class, 'orderConfirmation'])->name('customer.order.confirmation');
});

// Admin Protected Routes (require authentication)
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
