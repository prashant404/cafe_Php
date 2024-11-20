<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IncomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminSettingsController;



Route::get('/', function () {
    return redirect('/login');
});

// Authentication routes
Auth::routes(['register' => false]);

Route::middleware('auth')->group(function () {
    // Dashboard route
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Product routes
    Route::resource('products', ProductController::class)->except(['show']);
    Route::get('/products/filter', [ProductController::class, 'filter'])->name('products.filter');

    // Order routes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('orders/{id}/pdf', [OrderController::class, 'generatePDF'])->name('orders.pdf');

    // Category routes
    Route::resource('categories', CategoryController::class)->except(['show', 'edit', 'update']);

    Route::get('/income', [IncomeController::class, 'index'])->name('income.index');
    Route::get('/admin/settings', [AdminSettingsController::class, 'index'])->name('admin.settings');
Route::post('/admin/settings/update', [AdminSettingsController::class, 'update'])->name('admin.settings.update');
});

// Logout route
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
