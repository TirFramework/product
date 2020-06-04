<?php

namespace Tir\Store\Shipping;

use Tir\Setting\Facades\Stg;
use Tir\Store\Cart\Facades\Cart;
use Tir\Store\Currency\Support\Money;

class Method
{
    public $name;
    public $label;
    public $cost;

    public function __construct($name, $label, $cost)
    {
        $this->name = $name;
        $this->label = $label;
        $this->cost = Money::inDefaultCurrency($cost);
    }

    public function available()
    {
        if ($this->name !== 'free_shipping') {
            return true;
        }

        return $this->freeShippingMethodIsAvailable();
    }

    private function freeShippingMethodIsAvailable()
    {
        $minimumAmount = Money::inDefaultCurrency(Stg::get('free_shipping_min_amount'));

        return Cart::subTotal()->greaterThanOrEqual($minimumAmount);
    }
}
