<?php

namespace Tir\Store\Account\Http\Controllers;

use Illuminate\Routing\Controller;

class AccountDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $my = auth()->user();
        $recentOrders = auth()->user()->recentOrders(5);

        return view(config('crud.front-template').'::public.account.dashboard.index', compact('my', 'recentOrders'));
    }
}
