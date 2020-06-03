<?php

namespace Tir\Store\Cart\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tir\Store\Cart\Facades\Cart;

class RedirectIfCartIsEmpty
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Cart::isEmpty()) {
            return redirect()->route('cart.index');
        }

        return $next($request);
    }
}
