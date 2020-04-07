<?php

namespace Tir\Store;


use Illuminate\Support\ServiceProvider;

class StoreServiceProvider extends ServiceProvider
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
        //category module
            $this->loadRoutesFrom(__DIR__.'/Category/Routes/admin.php');
            $this->loadMigrationsFrom(__DIR__ .'/Category/Database/Migrations');
            $this->loadTranslationsFrom(__DIR__.'/Category/Resources/Lang/', 'category');

    }
}
