<?php
namespace App\Models\Concerns;

use App\Libraries\PaymentGateway\Adapters\AdapterInterface;
use App\Libraries\PaymentGateway\PaymentGateway;

trait WithPaymentGateway
{
    /**
     * Get payment gateway
     *
     * @return AdapterInterface
     */
    public function paymentGateway()
    {
        return PaymentGateway::make($this->payment_gateway);
    }
}