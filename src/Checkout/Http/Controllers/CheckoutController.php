<?php

namespace Tir\Store\Checkout\Http\Controllers;

use Exception;
use Tir\Page\Entities\Page;
use Tir\Setting\Facades\Stg;
use Tir\Store\Cart\Facades\Cart;
use Illuminate\Routing\Controller;
use Tir\Store\Payment\Facades\Gateway;
use Tir\Store\Checkout\Events\OrderPlaced;
use Tir\Store\Checkout\Services\OrderService;
use Tir\Store\Checkout\Services\CustomerService;
use Tir\Store\Order\Http\Requests\StoreOrderRequest;
use Tir\Store\Support\Country;

class CheckoutController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware(['cart_not_empty', 'check_stock', 'check_coupon_usage_limit']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cart = Cart::instance();
      $countries = Country::supported();
        $gateways = Gateway::all();
        $termsPageURL = Page::urlForPage(Stg::get('storefront_terms_page'));

        return view(config('crud.front-template').'::public.checkout.create', compact('cart', 'countries', 'gateways', 'termsPageURL'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Tir\Store\Order\Http\Requests\StoreOrderRequest $request
     * @param \Tir\Store\Checkout\Services\CustomerService $customerService
     * @param \Tir\Store\Checkout\Services\OrderService $orderService
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request, CustomerService $customerService, OrderService $orderService)
    {
        if (auth()->guest() && $request->create_an_account) {
            $customerService->register($request)->login();
        }

        $order = $orderService->create($request);

        $gateway = Gateway::get($request->payment_method);

        try {
            $response = $gateway->purchase($order, $request);
        } catch (Exception $e) {
            $orderService->delete($order);

            return back()->withInput()->withError($e->getMessage());
        }

        if ($response->isRedirect()) {
            return redirect($response->getRedirectUrl());
        } elseif ($response->isSuccessful()) {
            $order->storeTransaction($response);

            event(new OrderPlaced($order));

            return redirect()->route('checkout.complete.show');
        }

        $orderService->delete($order);

        return back()->withInput()->withError($response->getMessage());
    }
}
