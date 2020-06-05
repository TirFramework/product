<?php

namespace Tir\Store\Checkout\Listeners;

use Swift_TransportException;
use Tir\Setting\Facades\Stg;
use Tir\Store\Checkout\Mail\Invoice;
use Tir\Store\Checkout\Mail\NewOrder;
use Illuminate\Support\Facades\Mail;

class SendOrderEmails
{
    /**
     * Handle the event.
     *
     * @param \App\Events\OrderPlaced $event
     * @return void
     */
    public function handle($event)
    {
        try {
            if (Stg::get('admin_order_email')) {
                Mail::to(Stg::get('store_email'))
                    ->send(new NewOrder($event->order));
            }

            if (Stg::get('invoice_email')) {
                Mail::to($event->order->customer_email)
                    ->send(new Invoice($event->order));
            }
        } catch (Swift_TransportException $e) {
            //
        }
    }
}
