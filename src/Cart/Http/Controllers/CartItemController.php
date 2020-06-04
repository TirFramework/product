<?php

namespace Tir\Store\Cart\Http\Controllers;

use Illuminate\Http\Request;
use Tir\Store\Cart\Facades\Cart;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Routing\Controller;
use Tir\Store\Coupon\Checkers\MaximumSpend;
use Tir\Store\Coupon\Checkers\MinimumSpend;
use Tir\Store\Cart\Http\Requests\StoreCartItemRequest;
use Tir\Store\Coupon\Exceptions\MaximumSpendException;
use Tir\Store\Coupon\Exceptions\MinimumSpendException;

class CartItemController extends Controller
{
    private $checkers = [
        MinimumSpend::class,
        MaximumSpend::class,
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('in_stock')->only('store');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Tir\Store\Cart\Http\Requests\StoreCartItemRequest $request
     * @return \Illuminate\Http\Response
     */
//    public function store(StoreCartItemRequest $request)
    public function store(Request $request)
    {
        Cart::store($request->product_id, $request->qty, $request->options ?? []);

        return back()->withSuccess(trans('cart::messages.added'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param mixed $cartItemId
     * @return \Illuminate\Http\Response
     */
    public function update($cartItemId)
    {
        Cart::updateQuantity(decrypt($cartItemId), request('qty'));

        try {
            resolve(Pipeline::class)
                ->send(Cart::coupon())
                ->through($this->checkers)
                ->thenReturn();
        } catch (MinimumSpendException | MaximumSpendException $e) {
            Cart::removeOldCoupon();
        }

        return back()->withSuccess(trans('cart::messages.quantity_updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param mixed $cartItemId
     * @return \Illuminhtate\Http\Response
     */
    public function destroy($cartItemId)
    {
        Cart::remove(decrypt($cartItemId));

        return back()->withSuccess(trans('cart::messages.removed'));
    }
}
