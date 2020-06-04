<?php

namespace Tir\Store\Coupon\Checkers;

use Closure;
use Tir\Store\Cart\Facades\Cart;
use Tir\Store\Coupon\Exceptions\InapplicableCouponException;

class ExcludedCategories
{
    public function handle($coupon, Closure $next)
    {
        $coupon->load('excludeCategories');

        if ($coupon->excludeCategories->isEmpty()) {
            return $next($coupon);
        }

        foreach (Cart::items() as $cartItem) {
            if ($this->inExcludedCategories($coupon, $cartItem)) {
                throw new InapplicableCouponException;
            }
        }

        return $next($coupon);
    }

    private function inExcludedCategories($coupon, $cartItem)
    {
        return $coupon->excludeCategories->intersect($cartItem->product->categories)->isNotEmpty();
    }
}
