<?php

namespace Tir\Store\Coupon\Checkers;

use Closure;
use Tir\Store\Coupon\Exceptions\CouponUsageLimitReachedException;

class UsageLimitPerCustomer
{
    public function handle($coupon, Closure $next)
    {
        if ($coupon->perCustomerUsageLimitReached()) {
            throw new CouponUsageLimitReachedException;
        }

        return $next($coupon);
    }
}
