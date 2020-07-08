<?php

namespace Tir\Store\Order\Http\Controllers;

use Tir\Crud\Controllers\CrudController;
use Tir\Store\Order\Entities\Order;

class AdminOrderController extends CrudController
{


    protected $model = Order::class;


//    /**
//     * The relations to eager load on every query.
//     *
//     * @var array
//     */
//    protected $with = ['products', 'coupon', 'taxes'];
//
//    /**
//     * Label of the resource.
//     *
//     * @var string
//     */
//    protected $label = 'order::orders.order';
//
//    /**
//     * View path of the resource.
//     *
//     * @var string
//     */
//    protected $viewPath = 'order::admin.orders';
//
//    /**
//     * Form requests for the resource.
//     *
//     * @var array
//     */
//    protected $validation = SaveOrderRequest::class;
}
