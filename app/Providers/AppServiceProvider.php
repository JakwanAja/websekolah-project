<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\YouTubeService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register YouTube Service as singleton
        $this->app->singleton(YouTubeService::class, function ($app) {
            return new YouTubeService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}