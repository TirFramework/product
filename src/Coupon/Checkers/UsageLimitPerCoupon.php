<?php

namespace Tir\Store\Coupon\Checkers;

use Closure;
use Tir\Store\Coupon\Exceptions\CouponUsageLimitReachedException;

class UsageLimitPerCoupon
{
    public function handle($coupon, Closure $next)
    {
        if ($coupon->usageLimitReached()) {
            throw new CouponUsageLimitReachedException;
        }

        return $next($coupon);
    }
}
