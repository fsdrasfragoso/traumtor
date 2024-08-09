<?php

namespace App\Listeners;

use App\Events\PaymentDeletedEvent;
use App\Services\PaymentService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePaymentDeleted implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param PaymentDeletedEvent $event
     * @throws \Exception
     */
    public function handle(PaymentDeletedEvent $event)
    {
        (new PaymentService())->processPaymentDeleted($event->payment);
    }
}
