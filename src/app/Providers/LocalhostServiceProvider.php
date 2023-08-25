<?php

namespace App\Providers;

use App\Services\Localhost;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class LocalhostServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(Localhost::class, function (Application $app) {
            return new Localhost();
        });
    }

}
