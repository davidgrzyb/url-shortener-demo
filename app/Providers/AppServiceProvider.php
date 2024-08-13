<?php

namespace App\Providers;

use App\Services\D1Connector\L1ServiceProvider;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(L1ServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {}
}
