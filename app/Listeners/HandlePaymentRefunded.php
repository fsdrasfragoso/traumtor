<?php

namespace App\Listeners;

use App\Events\PaymentRefundedEvent;
use App\Services\PaymentService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePaymentRefunded implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param PaymentRefundedEvent $event
     * @throws \Exception
     */
    public function handle(PaymentRefundedEvent $event)
    {
        (new PaymentService())->processPaymentRefunded($event->payment, $event->amount, $event->refundReason);
    }
}
