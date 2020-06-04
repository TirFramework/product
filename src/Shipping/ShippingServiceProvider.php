<?php

namespace Tir\Store\Shipping;

use Illuminate\Support\ServiceProvider;
use Tir\Setting\Facades\Stg;
use Tir\Store\Shipping\Facades\ShippingMethod;

class ShippingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if (! config('app.installed')) {
            return;
        }

        $this->registerFreeShipping();
        $this->registerLocalPickup();
        $this->registerFlatRate();
    }

    private function registerFreeShipping()
    {
        if (! Stg::get('free_shipping_enabled')) {
            return;
        }

        ShippingMethod::register('free_shipping', function () {
            return new Method('free_shipping', Stg::get('free_shipping_label'), 0);
        });
    }

    private function registerLocalPickup()
    {
        if (! Stg::get('local_pickup_enabled')) {
            return;
        }

        ShippingMethod::register('local_pickup', function () {
            return new Method('local_pickup', Stg::get('local_pickup_label'), Stg::get('local_pickup_cost'));
        });
    }

    private function registerFlatRate()
    {
        if (! Stg::get('flat_rate_enabled')) {
            return;
        }

        ShippingMethod::register('flat_rate', function () {
            return new Method('flat_rate', Stg::get('flat_rate_label'), Stg::get('flat_rate_cost'));
        });
    }
}
