<?php

namespace App\Events;

use App\Models\Payment;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class PaymentRefundedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Payment
     */
    public $payment;
    public $amount;
    public $refundReason;

    /**
     * Create a new event instance.
     *
     * @param Payment $payment
     * @return void
     */
    public function __construct(Payment $payment, $amount, $refundReason)
    {
        $this->payment = $payment;
        $this->amount = $amount;
        $this->refundReason = $refundReason;
    }
}
