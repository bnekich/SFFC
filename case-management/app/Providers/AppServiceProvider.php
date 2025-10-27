<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Gate;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // if (env('APP_ENV') === 'production') {
        //     URL::forceScheme('https');
        // }
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        // Administrator has all permissions
        Gate::before(function ($user, $ability) {
            if ($user->hasRole('Administrator')) {
                return $user->hasRole('Administrator') ? true : null;
            }
        });

        Paginator::defaultView('vendor.pagination.bootstrap-5');
        // Optionally, set simple pagination too:
        Paginator::defaultSimpleView('vendor.pagination.bootstrap-5');
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
