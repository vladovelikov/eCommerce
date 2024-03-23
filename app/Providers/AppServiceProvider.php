<?php

namespace App\Providers;

use App\Models\Settings;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
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
        Paginator::useBootstrap();

        /** set time zone */
        $settings = Settings::first();

        if ($settings && $settings->timezone) {
            Config::set('app.timezone', $settings->timezone);
        }

        /** Share currency in all views */
        View::composer('*', function ($view) use ($settings) {
            $view->with('settings', $settings);
        });
    }
}
