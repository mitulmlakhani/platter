<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        Passport::tokensExpireIn(now()->addMinutes(env('AUTH2_EXPIRY_TIME')));

        // Mandatory to define Scope
        Passport::tokensCan([
            'full' => 'Full Access Role',
            'basic' => 'Basic Access Role'
        ]);

        Passport::setDefaultScope([
            'basic'
        ]);
    }
}
