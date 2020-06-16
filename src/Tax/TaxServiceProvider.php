<?php

namespace Tir\Store\Tax;

use Illuminate\Support\ServiceProvider;

class TaxServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/Routes/admin.php');
        $this->loadRoutesFrom(__DIR__.'/Routes/public.php');
        $this->loadMigrationsFrom(__DIR__ .'/Database/Migrations');
        $this->loadTranslationsFrom(__DIR__.'/Resources/Lang/', 'tax');
        $this->loadViewsFrom(__DIR__.'/Resources/Views/', 'tax');

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

    }
}
