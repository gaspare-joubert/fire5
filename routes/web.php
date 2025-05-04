<?php

use App\Http\Controllers\Web\UserController;
use Illuminate\Support\Facades\Route;

// Home/login route
Route::get('/', [UserController::class, 'home'])->name('web.home');

// Guest routes group
Route::middleware(['user.guest'])->group(function () {
    // Registration routes
    Route::get('/users/create', [UserController::class, 'create'])->name('web.users.create');
    Route::post('/users', [UserController::class, 'store'])->name('web.users.store');

    // Login route
    Route::post('/login', [UserController::class, 'login'])->name('web.users.login');
});

// Authenticated user routes group
Route::middleware(['user.auth'])->group(function () {
    // User resource routes (excluding create and store which are for guests)
    Route::resource('users', UserController::class)->except(['create', 'store']);

    // Explicit user show route
    Route::get('/users/{id}', [UserController::class, 'show'])->name('web.users.show');

    // Logout route
    Route::post('/logout', [UserController::class, 'logout'])->name('web.users.logout');
});
