<?php

namespace Tir\Store\Order\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Tir\Store\Order\Entities\Order;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Tir\Store\Order\Mail\OrderStatusChanged;

class OrderStatusController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param \Tir\Store\Order\Entities\Order $request
     * @return \Illuminate\Http\Response
     */
    public function update(Order $order)
    {
        $order->update(['status' => request('status')]);

        $message = trans('order::messages.status_updated');

        if (setting('order_status_email')) {
            Mail::to($order->customer_email)
                ->send(new OrderStatusChanged($order));
        }

        return $message;
    }
}
