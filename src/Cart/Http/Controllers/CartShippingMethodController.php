<?php

namespace Tir\Store\Cart\Http\Controllers;

use Tir\Store\Cart\Facades\Cart;
use Illuminate\Routing\Controller;
use Tir\Store\Shipping\Facades\ShippingMethod;

class CartShippingMethodController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $shippingMethod = ShippingMethod::get(request('shipping_method'));

        Cart::addShippingMethod($shippingMethod);

        return response()->json([
            'discount' => Cart::discount()->convertToCurrentCurrency()->format(),
            'total' => Cart::total()->convertToCurrentCurrency()->format(),
        ]);
    }
}
