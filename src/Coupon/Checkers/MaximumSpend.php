<?php

namespace Tir\Store\Coupon\Checkers;

use Closure;
use Tir\Store\Coupon\Exceptions\MaximumSpendException;

class MaximumSpend
{
    public function handle($coupon, Closure $next)
    {
        if ($coupon->spentMoreThanMaximumAmount()) {
            throw new MaximumSpendException($coupon->maximum_spend);
        }

        return $next($coupon);
    }
}
