<?php

namespace App\Models\Concerns;

trait WithPaymentGatewayAdminColumn {

    /**
     * Get payment gateway admin column
     *
     * @return string
     */
    public function getPaymentGatewayAdminColumn()
    {
        return modelAttribute(self::class, 'options.payment_gateway.'.$this->payment_gateway);
    }
}