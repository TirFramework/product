<?php

namespace Tir\Store\Tax\Providers;

use Tir\Store\Tax\Admin\TaxTabs;
use Tir\Store\Support\Traits\AddsAsset;
use Illuminate\Support\ServiceProvider;
use Tir\Store\Support\Traits\LoadsConfig;
use Tir\Store\Admin\Ui\Facades\TabManager;

class TaxServiceProvider extends ServiceProvider
{
    use AddsAsset, LoadsConfig;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->loadRoutesFrom(__DIR__.'/Routes/admin.php');
        $this->loadRoutesFrom(__DIR__.'/Routes/public.php');
        $this->loadMigrationsFrom(__DIR__ .'/Database/Migrations');
        $this->loadTranslationsFrom(__DIR__.'/Resources/Lang/', 'tax');
        $this->loadViewsFrom(__DIR__.'/Resources/Views/', 'tax');
    }
}
