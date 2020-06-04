<?php

namespace Tir\Store\Coupon\Checkers;

use Closure;
use Tir\Store\Coupon\Exceptions\InvalidCouponException;

class ValidCoupon
{
    public function handle($coupon, Closure $next)
    {
        if ($coupon->invalid()) {
            throw new InvalidCouponException;
        }

        return $next($coupon);
    }
}
