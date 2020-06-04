<?php

namespace Tir\Store\Order\Providers;

use Tir\Store\Support\Traits\AddsAsset;
use Illuminate\Support\ServiceProvider;
use Tir\Store\Support\Traits\LoadsConfig;

class OrderServiceProvider extends ServiceProvider
{
    use AddsAsset, LoadsConfig;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->addAdminAssets('admin.orders.show', ['admin.order.css', 'admin.order.js']);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->loadConfigs(['assets.php', 'permissions.php']);
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }
}
