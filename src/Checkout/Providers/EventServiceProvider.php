<?php

namespace Tir\Store\Checkout\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \Tir\Store\Checkout\Events\OrderPlaced::class => [
            \Tir\Store\Checkout\Listeners\UpdateOrderStatus::class,
            \Tir\Store\Checkout\Listeners\SendOrderEmails::class,
            \Tir\Store\Checkout\Listeners\AddPlacedOrderToSession::class,
        ],
    ];
}
