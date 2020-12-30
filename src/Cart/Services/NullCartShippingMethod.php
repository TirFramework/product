<?php

namespace Tir\Store\Cart\Services;

use Tir\Store\Currency\Support\Money;

class NullCartShippingMethod
{
    public function name()
    {
        //
    }

    public function title()
    {
        //
    }

    public function cost()
    {
        return Money::inDefaultCurrency(0);
    }
}
