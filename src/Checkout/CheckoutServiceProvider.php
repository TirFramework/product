<?php

namespace Tir\Store\Checkout;


use Illuminate\Support\ServiceProvider;


class CheckoutServiceProvider extends ServiceProvider
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


        //Review module
//        $this->loadRoutesFrom(__DIR__.'/Review/Routes/admin.php');
//        $this->loadRoutesFrom(__DIR__.'/Review/Routes/public.php');
//        $this->loadMigrationsFrom(__DIR__ .'/Review/Database/Migrations');
//        $this->loadTranslationsFrom(__DIR__.'/Review/Resources/Lang/', 'review');
//        $this->loadViewsFrom(__DIR__.'/Review/Resources/Views/', 'review');


        //checkout
//        $this->loadRoutesFrom(__DIR__.'/Review/Routes/admin.php');
        $this->loadRoutesFrom(__DIR__.'/Routes/public.php');



    }


}
