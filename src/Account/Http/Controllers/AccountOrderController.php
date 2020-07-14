<?php

namespace Tir\Store\Account\Http\Controllers;

use Illuminate\Routing\Controller;

class AccountOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = auth()->user()
            ->orders()
            ->latest()
            ->paginate(15);

        return view(config('crud.front-template').'::public.account.orders.index', compact('orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = auth()->user()
            ->orders()
            ->with(['products', 'coupon', 'taxes'])
            ->where('id', $id)
            ->firstOrFail();

        return view(config('crud.front-template').'::public.account.orders.show', compact('order'));
    }
}
