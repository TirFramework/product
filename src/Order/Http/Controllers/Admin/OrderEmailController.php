<?php

namespace Tir\Store\Order\Http\Controllers\Admin;

use Tir\Store\Order\Entities\Order;
use Illuminate\Routing\Controller;
use Tir\Store\Checkout\Mail\Invoice;
use Illuminate\Support\Facades\Mail;

class OrderEmailController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \Tir\Store\Order\Entities\Order $order
     * @return \Illuminate\Http\Response
     */
    public function store(Order $order)
    {
        Mail::to($order->customer_email)
            ->send(new Invoice($order));

        return back()->with('success', trans('order::messages.invoice_sent'));
    }
}
