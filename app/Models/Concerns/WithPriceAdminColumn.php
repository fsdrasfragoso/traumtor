<?php

namespace App\Models\Concerns;

trait WithPriceAdminColumn {

    /**
     * Get price admin column
     *
     * @param bool $export
     * @return mixed|string
     */
    public function getPriceAdminColumn($export = false)
    {
        if($this->price) {
            return moneyFormat($this->price);
        }

        return null;
    }
}