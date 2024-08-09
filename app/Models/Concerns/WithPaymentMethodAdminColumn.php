<?php

namespace App\Models\Concerns;

trait WithPaymentMethodAdminColumn {

    /**
     * Get payment method admin column
     *
     * @return string
     */
    public function getPaymentMethodAdminColumn()
    {
        return modelAttribute(self::class, 'options.payment_method.'.$this->payment_method);
    }

}