<?php

namespace Tir\Store\Checkout;


use Illuminate\Support\ServiceProvider;
use Tir\Store\Checkout\Providers\EventServiceProvider;


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

        $this->loadRoutesFrom(__DIR__.'/Routes/public.php');
        $this->app->register(EventServiceProvider::class);



    }


}
