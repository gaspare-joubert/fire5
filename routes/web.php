<?php

use App\Http\Controllers\Web\FileController;
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
    // Routes accessible to any authenticated user (no ownership check needed)
    Route::post('/logout', [UserController::class, 'logout'])->name('web.users.logout');

    // File routes
    Route::post('/files/upload', [FileController::class, 'store'])->name('files.upload');

    // Admin routes
    Route::middleware(['user.admin'])->prefix('admin')->group(function () {
        Route::get('users', [UserController::class, 'index'])->name('web.admin.users.index');
    });

    // User routes with ownership check
    Route::middleware(['user.ownership'])->group(function () {
        // Explicit user routes with custom names
        Route::get('/users/{id}', [UserController::class, 'show'])->name('web.users.show');
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('web.users.edit');
        Route::match(['put', 'patch'], '/users/{id}', [UserController::class, 'update'])->name('web.users.update');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('web.users.destroy');
    });
});
