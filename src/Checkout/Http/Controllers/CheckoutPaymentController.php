<?php

namespace Tir\Store\Checkout\Http\Controllers;


use Illuminate\Routing\Controller;
use Tir\Store\Payment\Facades\Gateway;
use Tir\Store\Support\Request;


class CheckoutPaymentController extends Controller
{

    public function callback($paymentGateway){
        $gateway = Gateway::get($paymentGateway);
        return $gateway->check(request()->all());
    }




}
