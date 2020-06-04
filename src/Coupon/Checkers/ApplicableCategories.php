<?php

namespace Tir\Store\Coupon\Checkers;

use Closure;
use Tir\Store\Cart\Facades\Cart;
use Tir\Store\Coupon\Exceptions\InapplicableCouponException;

class ApplicableCategories
{
    public function handle($coupon, Closure $next)
    {
        $coupon->load('categories');

        if ($coupon->categories->isEmpty()) {
            return $next($coupon);
        }

        $cartItems = Cart::items()->filter(function ($cartItem) use ($coupon) {
            return $coupon->categories->intersect($cartItem->product->categories)->isNotEmpty();
        });

        if ($cartItems->isEmpty()) {
            throw new InapplicableCouponException;
        }

        return $next($coupon);
    }
}
