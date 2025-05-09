<?php
/**
 * @file api.php
 *
 * @author Gaspare Joubert
 * @date 02/05/2025 15:58
 *
 */

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\UserController;

// API V1 routes
Route::prefix('v1')->group(function () {
    // Guest routes group
    Route::middleware('guest')->group(function () {
        // Auth routes
        Route::post('login', [UserController::class, 'login']);

        // User registration
        Route::post('users', [UserController::class, 'store']);
    });

    // Protected routes group
    Route::middleware('auth:sanctum')->group(function () {
        // Current user route - any authenticated user can access their own info
        Route::get('/user', [UserController::class, 'currentUser']);

        // Admin routes
        Route::middleware(['user.admin'])->prefix('admin')->group(function () {
            Route::get('users', [UserController::class, 'index']);
            Route::patch('users/{id}', [UserController::class, 'update']);
            Route::delete('users/{id}', [UserController::class, 'destroy']);
        });

        // User resource routes with ownership check
        Route::middleware(['user.ownership'])->group(function () {
            Route::apiResource('users', UserController::class)->except(['store', 'index']);
        });
    });
});
