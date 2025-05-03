<?php

use App\Http\Controllers\Web\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Guest-only routes (registration)
Route::get('/users/create', [UserController::class, 'create'])->middleware(['user.guest'])->name('web.users.create');
Route::post('/users', [UserController::class, 'store'])->middleware(['user.guest'])->name('web.users.store');

// User resource routes - apply middleware per action
Route::resource('users', UserController::class)->except(['create', 'store'])->middleware(['user.auth']);

// Dashboard route
Route::get('/dashboard', function () {
    return view('users.show', ['user' => auth()->user()]);
})->middleware(['auth'])->name('dashboard');

Route::post('/logout', [UserController::class, 'logout'])->middleware(['user.auth'])->name('web.users.logout');

