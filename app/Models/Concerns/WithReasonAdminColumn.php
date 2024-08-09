<?php

namespace App\Models\Concerns;

trait WithReasonAdminColumn {

    /**
     * Get reason admin column
     *
     * @param bool $export
     * @return mixed|string
     */
    public function getReasonAdminColumn($export = false)
    {
        return modelAttribute(self::class, 'options.reason.' . $this->reason);
    }
}