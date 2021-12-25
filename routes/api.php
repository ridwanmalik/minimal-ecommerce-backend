<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\AuthController;

// API V1
Route::prefix('v1')->as('api.v1.')->group(function () {
    Route::post('register', [AuthController::class, 'register'])->name('register');
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
