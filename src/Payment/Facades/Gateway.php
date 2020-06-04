<?php

namespace Tir\Store\Payment\Facades;

use Illuminate\Support\Facades\Facade;

class Gateway extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Tir\Store\Payment\Gateway::class;
    }
}
