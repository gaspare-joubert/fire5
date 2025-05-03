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

// API routes
Route::prefix('v1')->group(function () {
    // Guest-only routes (must NOT be authenticated)
    Route::middleware('guest')->group(function () {
        // Auth routes
        Route::post('login', [UserController::class, 'login']);

        // User registration
        Route::post('users', [UserController::class, 'store']);
        Route::get('users/create', [UserController::class, 'create']);
    });

    // Protected routes (require authentication)
    Route::middleware('auth:sanctum')->group(function () {
        // Current user route
        Route::get('/user', [UserController::class, 'currentUser']);

        // Protected user resource routes (excluding store and create)
        Route::apiResource('users', UserController::class)->except(['store', 'create']);
    });
});
