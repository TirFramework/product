<?php

namespace Tir\Store\Checkout\Listeners;

use Tir\Store\Order\Entities\Order;

class UpdateOrderStatus
{
    /**
     * Handle the event.
     *
     * @param \Tir\Store\Checkout\Events\OrderPlaced $event
     * @return void
     */
    public function handle($event)
    {
        $event->order->update(['status' => Order::PENDING]);
    }
}
