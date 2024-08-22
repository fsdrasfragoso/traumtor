<?php

namespace App\Models\Concerns;

trait WithCaptainNameAdminColumn {

    /**
     * Get captain admin column
     *
     * @param bool $export
     * @return mixed|string
     */
    public function getCaptainNameAdminColumn($export = false)
    {
        if ($this->captain) {
            return $this->captain->name;
        }

        return '';
    }
}
