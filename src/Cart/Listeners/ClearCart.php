<?php

namespace Tir\Store\Cart\Listeners;

use Tir\Store\Cart\Facades\Cart;

class ClearCart
{
    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle()
    {
        Cart::clear();
    }
}
