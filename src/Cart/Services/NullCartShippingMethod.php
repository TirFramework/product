<?php

namespace Tir\Store\Cart;

use Modules\Support\Money;

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
