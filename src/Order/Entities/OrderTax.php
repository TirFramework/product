<?php

namespace Tir\Store\Order\Entities;

use Tir\Store\Support\Money;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderTax extends Pivot
{
    public function getAmountAttribute($amount)
    {
        return Money::inDefaultCurrency($amount);
    }
}
