<?php

namespace Tir\Store\Checkout\Http\Controllers;

use Exception;
use Tir\Store\Order\Entities\Order;
use Illuminate\Routing\Controller;
use Tir\Store\Payment\Facades\Gateway;
use Tir\Store\Checkout\Events\OrderPlaced;
use Tir\Store\Checkout\Services\OrderService;

class CheckoutCompleteController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param int $orderId
     * @param string $paymentMethod
     * @param \Tir\Store\Checkout\Services\OrderService $orderService
     * @return \Illuminate\Http\Response
     */
    public function store($orderId, $paymentMethod, OrderService $orderService)
    {
        $order = Order::findOrFail($orderId);

        $gateway = Gateway::get($paymentMethod);

        try {
            $response = $gateway->complete($order);
        } catch (Exception $e) {
            $orderService->delete($order);

            return redirect()->route('checkout.create')
                ->withError($e->getMessage());
        }

        $order->storeTransaction($response);

        event(new OrderPlaced($order));

        session()->put('placed_order', $order);

        return redirect()->route(config('crud.frontend-template').'::checkout.complete.show');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $order = session('placed_order');

        if (is_null($order)) {
            return redirect()->route('home');
        }

        return view(config('crud.front-template').'::public.checkout.complete.show', compact('order'));
    }
}
