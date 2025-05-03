<?php

use App\Http\Controllers\Web\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('users.login');
});

// Guest-only routes (registration)
Route::get('/users/create', [UserController::class, 'create'])->middleware(['user.guest'])->name('web.users.create');
Route::post('/users', [UserController::class, 'store'])->middleware(['user.guest'])->name('web.users.store');

// User resource routes - apply middleware per action
Route::resource('users', UserController::class)->except(['create', 'store'])->middleware(['user.auth']);

// Logout route
Route::post('/logout', [UserController::class, 'logout'])->middleware(['user.auth'])->name('web.users.logout');

// Login route
Route::post('/login', [UserController::class, 'login'])->middleware(['user.guest'])->name('web.users.login');

// User routes
Route::get('/users/{id}', [UserController::class, 'show'])
    ->name('web.users.show')->middleware(['user.auth']);

//// Admin routes (with gate/middleware)
//Route::middleware(['can:admin'])->prefix('admin')->group(function () {
//    Route::get('/dashboard', [App\Http\Controllers\Web\Admin\DashboardController::class, 'index'])
//        ->name('admin.dashboard')->middleware(['user.auth']);
//});
