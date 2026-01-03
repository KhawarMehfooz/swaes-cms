<?php

namespace App\Providers;

use App\Models\Transaction;
use App\Observers\TransactionObserver;
use App\Settings\GeneralSettings;
use Filament\Support\Facades\FilamentIcon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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

        Transaction::observe(TransactionObserver::class);

        FilamentIcon::register([
            'panels::sidebar.collapse-button' => 'heroicon-o-x-mark',
            'panels::sidebar.expand-button' => 'heroicon-o-bars-3',
        ]);
    }
}
