<?php

namespace App\Providers;

use App\CSP\Policies\LocalDevelopmentPolicy;
use App\CSP\Policies\ProductionPolicy;
use App\Models\User;
use App\Services\FileService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(FileService::class, function ($app) {
            return new FileService();
        });

        // Register environment-specific CSP policy
        $this->app->bind('csp-policy', function ($app) {
            return $app->environment('local')
                ? new LocalDevelopmentPolicy()
                : new ProductionPolicy();
        });

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('admin', function (User $user) {
            return $user->isAdmin();
        });
    }
}
