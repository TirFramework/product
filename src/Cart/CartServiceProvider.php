<?php

namespace Tir\Store\Cart;

use Tir\Store\Cart\Providers\EventServiceProvider;
use Tir\Store\Cart\Services\Cart;
use Illuminate\Support\ServiceProvider;
//use Tir\Store\Support\Traits\LoadsConfig;
use Tir\Store\Cart\Http\Middleware\CheckCartStock;
use Tir\Store\Cart\Http\Middleware\CheckCouponUsageLimit;
use Tir\Store\Cart\Http\Middleware\CheckProductIsInStock;
use Tir\Store\Cart\Http\Middleware\RedirectIfCartIsEmpty;

class CartServiceProvider extends ServiceProvider
{

    /**
     * Array of checkout module specific middleware.
     *
     * @var array
     */
    private $middleware = [
        'in_stock' => CheckProductIsInStock::class,
        'check_stock' => CheckCartStock::class,
        'cart_not_empty' => RedirectIfCartIsEmpty::class,
        'check_coupon_usage_limit' => CheckCouponUsageLimit::class,
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        foreach ($this->middleware as $name => $middleware) {
            $this->app['router']->aliasMiddleware($name, $middleware);
        }

        $this->loadRoutesFrom(__DIR__.'/Routes/public.php');
        $this->loadTranslationsFrom(__DIR__.'/Resources/lang/', 'cart');

        $this->app->register(EventServiceProvider::class);


    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {


        $this->app->singleton(Cart::class, function ($app) {
            return new Cart(
                $app['session'],
                $app['events'],
                'cart',
                session()->getId(),
                config('modules.cart.config')
            );
        });

        $this->app->alias(Cart::class, 'cart');
    }


}
