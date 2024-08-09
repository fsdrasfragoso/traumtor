<?php

namespace App\Repositories;

use App\Events\PaymentRefundedEvent;
use App\Models\Payment;
use App\Models\Refund;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class RefundRepository extends CrudRepository
{
    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = Refund::class;

    /**
     * Find or create refund.
     *
     * @param string $externalCode
     * @param array  $attributes
     *
     * @return Refund
     *
     * @throws \Exception
     */
    public function findOrCreateRefund($filters, $attributes)
    {
        $paymentId = data_get($filters, 'payment_id');
        $refundedAt = data_get($filters, 'refunded_at');

        $payment = Payment::find($paymentId);

        $refund = Refund::query()
            ->where('payment_id', $paymentId)
            ->where('refunded_at', $refundedAt)
            ->first();
        
        if (!$refund) {
            $refund = $this->create($attributes);

            event(new PaymentRefundedEvent($payment, $refund->value, $refund->description ?? $payment->reason));
        }

        return $refund;
    }
}
