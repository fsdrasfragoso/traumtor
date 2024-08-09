<?php

namespace App\Models\Concerns;

trait WithPaymentGatewayCode
{
    /**
     * Payment Gateway code.
     *
     * @param null $paymentGateway
     * @return mixed|string
     */
    public function paymentGatewayCode($paymentGateway = null)
    {
        $code = $this->getKey();

        if ($paymentGateway) {
            return config('services.'.$paymentGateway.'.prefix').$code;
        }

        return $code;
    }
}
