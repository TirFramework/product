<?php

namespace Tir\Store\Coupon\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Tir\Store\Coupon\Entities\Coupon;
use Tir\Store\Admin\Traits\HasCrudActions;
use Tir\Store\Coupon\Http\Requests\SaveCouponRequest;

class CouponController extends Controller
{
    use HasCrudActions;

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Coupon::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'coupon::coupons.coupon';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'coupon::admin.coupons';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SaveCouponRequest::class;
}
