<?php

namespace App\Listeners;

use App\Events\PaymentConfirmedEvent;
use App\Services\PaymentService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePaymentConfirmed implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param PaymentConfirmedEvent $event
     * @throws \Exception
     */
    public function handle(PaymentConfirmedEvent $event)
    {
        (new PaymentService())->processPaymentConfirmed($event->payment);
    }
}
