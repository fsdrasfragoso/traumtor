<?php

namespace App\Models\Concerns;

trait WithFootballersAdminColumn {

    /**
     * Get footballers admin column
     *
     * @param bool $export
     * @return mixed|string
     */
    public function getFootballersAdminColumn($export = false)
    {
        if ($this->footballers) {
            $footballers = $this->footballers->pluck('name')->implode(', ');           
            return $footballers;
        }

        return '';
    }
}
