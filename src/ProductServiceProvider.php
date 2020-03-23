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

        //$this->loadViewsFrom(__DIR__.'/Resources/Views', 'product');

        $this->loadTranslationsFrom(__DIR__.'/Resources/Lang/', 'product');

    }
}
