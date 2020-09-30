<?php

namespace Tir\Store\Checkout\Http\Controllers;


use Illuminate\Routing\Controller;
use Tir\Store\Support\Request;


class CheckoutPaymentController extends Controller
{

    public function callback($paymentGateway){
        $gateway = resolve($paymentGateway);
        $gateway->check(request()->all());
    }




}
