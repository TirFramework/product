<?php

namespace Tir\Store\Checkout\Listeners;

class AddPlacedOrderToSession
{
    /**
     * Handle the event.
     *
     * @param \Tir\Store\Checkout\Events\OrderPlaced $event
     * @return void
     */
    public function handle($event)
    {
        session()->flash('placed_order', $event->order);
    }
}
