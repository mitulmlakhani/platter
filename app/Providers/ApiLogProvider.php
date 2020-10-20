<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ApiLogProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('apilog', function () {
            return new \App\Facades\ApiLog;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
