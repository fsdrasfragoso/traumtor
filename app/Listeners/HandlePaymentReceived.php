<?php

namespace App\Listeners;

use App\Events\PaymentReceivedEvent;
use App\Services\PaymentService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePaymentReceived implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param PaymentReceivedEvent $event
     * @throws \Exception
     */
    public function handle(PaymentReceivedEvent $event)
    {
        (new PaymentService())->processPaymentReceived($event->payment);
    }
}
