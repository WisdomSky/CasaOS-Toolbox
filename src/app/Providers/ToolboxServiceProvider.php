<?php

namespace App\Providers;


use App\Services\Toolbox;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class ToolboxServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(Toolbox::class, function (Application $app) {
            return new Toolbox();
        });
    }

}
