<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
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

        config(['app.locale' => 'id']);
        Carbon::setLocale(('id'));
        date_default_timezone_set('Asia/Jakarta');

        // if (env('APP_KEY') !== 'local') {
        //     URL::forceScheme('https');
        // }

        if ($this->app->environment('production')) {
            \URL::forceScheme('https');
        }

        // if(config('app.env') === 'production') {
        //     URL::forceScheme('https');
        // }
    }
}
