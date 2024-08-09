<?php

namespace App\Listeners;

use App\Events\PaymentOverdueEvent;
use App\Services\PaymentService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePaymentOverdue implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param PaymentOverdueEvent $event
     * @throws \Exception
     */
    public function handle(PaymentOverdueEvent $event)
    {
        (new PaymentService())->processPaymentOverdue($event->payment);
    }
}
