<?php

namespace App\Models\Concerns;

trait WithNameAdminColumn {

    /**
     * Get name admin column
     *
     * @param bool $export
     * @return mixed|string
     */
    public function getNameAdminColumn($export = false)
    {
        if($export) {
            return $this->name;
        }

        return $this->name . '<br><code>' . $this->slug . '</code>';
    }
}