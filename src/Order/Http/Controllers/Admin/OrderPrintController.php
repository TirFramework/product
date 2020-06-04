<?php

namespace Tir\Store\Order\Http\Controllers\Admin;

use Tir\Store\Order\Entities\Order;
use Illuminate\Routing\Controller;

class OrderPrintController extends Controller
{
    /**
     * Show the specified resource.
     *
     * @param \Tir\Store\Order\Entities\Order $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $order->load('products', 'coupon', 'taxes');

        return view('order::admin.orders.print.show', compact('order'));
    }
}
