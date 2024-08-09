<?php

namespace App\Models\Concerns;

trait WithRefundAmountAdminColumn {

    /**
     * Get refund amount admin column
     *
     * @param bool $export
     * @return mixed|string
     */
    public function getRefundAmountAdminColumn($export = false)
    {
        if($this->refund_amount) {
            return moneyFormat($this->refund_amount);
        }

        return null;
    }
}