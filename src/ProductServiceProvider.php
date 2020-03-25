<?php

namespace Tir\Product;


use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */

    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/Routes/web.php');

        $this->loadMigrationsFrom(__DIR__ .'/Database/Migrations');

        $this->loadTranslationsFrom(__DIR__.'/Resources/Lang/', 'product');

    }
}
