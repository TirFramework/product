<?php

namespace Tir\Store\Coupon\Http\Controllers;

use Tir\Store\Cart\Facades\Cart;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Routing\Controller;
use Tir\Store\Coupon\Entities\Coupon;
use Tir\Store\Coupon\Checkers\ValidCoupon;
use Tir\Store\Coupon\Checkers\CouponExists;
use Tir\Store\Coupon\Checkers\MaximumSpend;
use Tir\Store\Coupon\Checkers\MinimumSpend;
use Tir\Store\Coupon\Checkers\ExcludedProducts;
use Tir\Store\Coupon\Checkers\ApplicableProducts;
use Tir\Store\Coupon\Checkers\ExcludedCategories;
use Tir\Store\Coupon\Checkers\UsageLimitPerCoupon;
use Tir\Store\Coupon\Checkers\ApplicableCategories;
use Tir\Store\Coupon\Checkers\UsageLimitPerCustomer;

class CartCouponController extends Controller
{
    private $checkers = [
        CouponExists::class,
        ValidCoupon::class,
        MinimumSpend::class,
        MaximumSpend::class,
        ApplicableProducts::class,
        ExcludedProducts::class,
        ApplicableCategories::class,
        ExcludedCategories::class,
        UsageLimitPerCoupon::class,
        UsageLimitPerCustomer::class,
    ];

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $coupon = Coupon::where('code', request('coupon'))->first();

        resolve(Pipeline::class)
            ->send($coupon)
            ->through($this->checkers)
            ->then(function ($coupon) {
                Cart::applyCoupon($coupon);
            });

        return back()->withSuccess(trans('coupon::messages.applied'));
    }
}
