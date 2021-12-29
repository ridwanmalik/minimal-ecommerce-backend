<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;


Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'is_admin']], function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('products', ProductController::class);
    Route::resource('orders', OrderController::class)->only(['index', 'destroy']);
    Route::get('changeOrderStatus', [OrderController::class, 'changeOrderStatus']);
});

require __DIR__ . '/auth.php';
