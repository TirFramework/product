<?php

namespace Tir\Store;


use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Laravel\Scout\EngineManager;
use Tir\Store\Search\MySqlSearchEngine;

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
        $this->loadTranslationsFrom(__DIR__.'/Attribute/Resources/Lang/', 'attributeSet');
        $this->loadViewsFrom(__DIR__.'/Attribute/Resources/Views/', 'attribute');

        //Option module
        $this->loadRoutesFrom(__DIR__.'/Option/Routes/admin.php');
        $this->loadMigrationsFrom(__DIR__ .'/Option/Database/Migrations');
        $this->loadTranslationsFrom(__DIR__.'/Option/Resources/Lang/', 'option');
        $this->loadViewsFrom(__DIR__.'/Option/Resources/Views/', 'option');

        //Product module
        $this->loadRoutesFrom(__DIR__.'/Product/Routes/admin.php');
        $this->loadRoutesFrom(__DIR__.'/Product/Routes/public.php');
        $this->loadMigrationsFrom(__DIR__ .'/Product/Database/Migrations');
        $this->loadTranslationsFrom(__DIR__.'/Product/Resources/Lang/', 'product');
        $this->loadViewsFrom(__DIR__.'/Product/Resources/Views/', 'product');

        //Review module
        $this->loadRoutesFrom(__DIR__.'/Review/Routes/admin.php');
        $this->loadRoutesFrom(__DIR__.'/Review/Routes/public.php');
        $this->loadMigrationsFrom(__DIR__ .'/Review/Database/Migrations');
        $this->loadTranslationsFrom(__DIR__.'/Review/Resources/Lang/', 'review');
        $this->loadViewsFrom(__DIR__.'/Review/Resources/Views/', 'review');

        //Register Search Engine
        $this->registerMysqlSearchEngine();
    }


    private function registerMysqlSearchEngine()
    {
        $this->app[EngineManager::class]->extend('mysql', function () {
            return new MySqlSearchEngine;
        });

    }


}
