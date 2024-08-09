<?php

namespace App\Providers;

use App\Events\PaymentDeletedEvent;
use App\Events\PaymentOverdueEvent;
use App\Events\PaymentConfirmedEvent;
use App\Events\PaymentReceivedEvent;
use App\Events\PaymentRefundedEvent;
use App\Listeners\HandlePaymentDeleted;
use App\Listeners\HandlePaymentOverdue;
use App\Listeners\HandlePaymentConfirmed;
use App\Listeners\HandlePaymentReceived;
use App\Listeners\HandlePaymentRefunded;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        PaymentDeletedEvent::class => [
            HandlePaymentDeleted::class,
        ],
        PaymentOverdueEvent::class => [
            HandlePaymentOverdue::class,
        ],
        PaymentConfirmedEvent::class => [
            HandlePaymentConfirmed::class,
        ],
        PaymentReceivedEvent::class => [
            HandlePaymentReceived::class,
        ],
        PaymentRefundedEvent::class => [
            HandlePaymentRefunded::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
