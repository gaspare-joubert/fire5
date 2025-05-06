<?php

use App\Http\Middleware\AdminAccess;
use App\Http\Middleware\UserOwnershipCheck;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

return Application::configure(basePath: dirname(__DIR__))->withRouting(
    web:      __DIR__ . '/../routes/web.php',
    commands: __DIR__ . '/../routes/console.php',
    health:   '/up',
)->withMiddleware(function (Middleware $middleware) {
    $middleware->api(append: [
                                 EnsureFrontendRequestsAreStateful::class,
                             ]);

    // Define middleware aliases
    $middleware->alias([
                           'auth'           => Authenticate::class,
                           'guest'          => RedirectIfAuthenticated::class,
                           'verified'       => EnsureEmailIsVerified::class,
                           'admin'          => AdminAccess::class,
                           'user.ownership' => UserOwnershipCheck::class,
                       ]);

    // Add middleware groups specifically for user operations
    $middleware->appendToGroup('user.guest', [
        RedirectIfAuthenticated::class,
    ]);

    $middleware->appendToGroup('user.auth', [
        Authenticate::class,
    ]);

    $middleware->appendToGroup('user.admin', [
        AdminAccess::class,
    ]);

    $middleware->appendToGroup('user.ownership', [
        UserOwnershipCheck::class,
    ]);
})->withExceptions(function (Exceptions $exceptions) {
    //
})->create();
