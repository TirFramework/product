<?php

namespace Tir\Store\Coupon\Checkers;

use Closure;
use Tir\Store\Coupon\Exceptions\CouponNotExistsException;

class CouponExists
{
    public function handle($coupon, Closure $next)
    {
        if (is_null($coupon)) {
            throw new CouponNotExistsException;
        }

        return $next($coupon);
    }
}
