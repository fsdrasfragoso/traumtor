<?php

namespace App\Models\Concerns;

trait WithAmountAdminColumn {

    /**
     * Get amount admin column
     *
     * @param bool $export
     * @return mixed|string
     */
    public function getAmountAdminColumn($export = false)
    {
        if($this->amount) {
            return moneyFormat($this->amount);
        }

        return null;
    }
}