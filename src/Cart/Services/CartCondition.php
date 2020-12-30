<?php

namespace Tir\Store\Cart\Services;

use Darryldecode\Cart\CartCondition as DarryldecodeCartCondition;
use Illuminate\Support\Arr;

class CartCondition extends DarryldecodeCartCondition
{
    public function getAttribute($key, $default = null)
    {
        return Arr::get($this->getAttributes(), $key, $default);
    }
}
