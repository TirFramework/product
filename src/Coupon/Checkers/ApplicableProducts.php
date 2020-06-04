<?php

namespace Tir\Store\Coupon\Checkers;

use Closure;
use Tir\Store\Cart\Facades\Cart;
use Tir\Store\Coupon\Exceptions\InapplicableCouponException;

class ApplicableProducts
{
    public function handle($coupon, Closure $next)
    {
        $coupon->load('products');

        if ($coupon->products->isEmpty()) {
            return $next($coupon);
        }

        $cartItems = Cart::items()->filter(function ($cartItem) use ($coupon) {
            return $coupon->products->contains($cartItem->product);
        });

        if ($cartItems->isEmpty()) {
            throw new InapplicableCouponException;
        }

        return $next($coupon);
    }
}
