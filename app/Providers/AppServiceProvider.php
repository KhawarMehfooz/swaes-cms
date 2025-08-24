<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Settings\GeneralSettings;
use Illuminate\Support\Facades\View;

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
        // Settings
        View::composer('*', function ($view) {
            $view->with('generalSettings', app(GeneralSettings::class));
        });
    }
}
