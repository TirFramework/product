<?php
namespace Tir\Store;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Tir\Crud\Events\PrepareFieldsEvent;
use Tir\Store\Category\Listeners\AddFieldListener;


class EventServiceProvider extends ServiceProvider
{

    /**
     * The event listener mappings for the Acl Package.
     *
     * @var array
     */
    protected $listen = [
        PrepareFieldsEvent::class => [
            AddFieldListener::class,
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}
