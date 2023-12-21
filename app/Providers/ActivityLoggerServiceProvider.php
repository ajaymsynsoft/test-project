<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Middleware\ActivityLoggerMiddleware;

class ActivityLoggerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->app->singleton(ActivityLoggerMiddleware::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        $this->app['router']->pushMiddlewareToGroup('web',ActivityLoggerMiddleware::class);
    }
}
