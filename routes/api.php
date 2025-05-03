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
    // Public auth routes
    Route::post('login', [UserController::class, 'login']);

    // User authenticated routes
    Route::middleware('auth:sanctum')->get('/user', [UserController::class, 'currentUser']);

    // User resource routes
    Route::apiResource('users', UserController::class);
});
