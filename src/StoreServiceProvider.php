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
        //Category module
            $this->loadRoutesFrom(__DIR__.'/Category/Routes/admin.php');
            $this->loadMigrationsFrom(__DIR__ .'/Category/Database/Migrations');
            $this->loadTranslationsFrom(__DIR__.'/Category/Resources/Lang/', 'category');

        //Attribute module
            $this->loadRoutesFrom(__DIR__.'/Attribute/Routes/admin.php');
            $this->loadMigrationsFrom(__DIR__ .'/Attribute/Database/Migrations');
            $this->loadTranslationsFrom(__DIR__.'/Attribute/Resources/Lang/', 'attribute');
            $this->loadViewsFrom(__DIR__.'/Attribute/Resources/Views/', 'attribute');

        //Option module
        $this->loadRoutesFrom(__DIR__.'/Option/Routes/admin.php');
        $this->loadMigrationsFrom(__DIR__ .'/Option/Database/Migrations');
        $this->loadTranslationsFrom(__DIR__.'/Option/Resources/Lang/', 'option');
        $this->loadViewsFrom(__DIR__.'/Option/Resources/Views/', 'option');

    }
}
