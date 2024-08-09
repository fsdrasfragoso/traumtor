<?php

namespace App\Models\Concerns;

trait WithPaymentGatewayId {

    /**
     * Payment Gateway id
     *
     * @param string $paymentGateway
     * @return mixed|string
     */
    public function paymentGatewayId($paymentGateway = null)
    {
        return $this->external_code;
    }

    /**
     * Update Payment Gateway Id
     *
     * @param string $id
     * @return bool
     */
    public function updatePaymentGatewayId($id)
    {
        return $this->forceFill(['external_code' => $id])->save();
    }
}
