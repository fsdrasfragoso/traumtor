<?php

namespace App\Models\Concerns;

trait WithTypeAdminColumn {

    /**
     * Get type admin column
     *
     * @return string
     */
    public function getTypeAdminColumn()
    {
        return modelAttribute(self::class, 'options.type.'.$this->type);
    }
}