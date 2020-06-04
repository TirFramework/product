<?php

namespace Tir\Store\Coupon\Checkers;

use Closure;
use Tir\Store\Cart\Facades\Cart;
use Tir\Store\Coupon\Exceptions\InapplicableCouponException;

class ExcludedProducts
{
    public function handle($coupon, Closure $next)
    {
        $coupon->load('excludeProducts');

        if ($coupon->excludeProducts->isEmpty()) {
            return $next($coupon);
        }

        foreach (Cart::items() as $cartItem) {
            if ($this->inExcludedProducts($coupon, $cartItem)) {
                throw new InapplicableCouponException;
            }
        }

        return $next($coupon);
    }

    private function inExcludedProducts($coupon, $cartItem)
    {
        return $coupon->excludeProducts->contains($cartItem->product);
    }
}
