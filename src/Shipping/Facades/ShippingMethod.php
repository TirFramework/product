<?php

namespace Tir\Store\Shipping\Facades;

use Illuminate\Support\Facades\Facade;

class ShippingMethod extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Tir\Store\Shipping\ShippingMethod::class;
    }
}
