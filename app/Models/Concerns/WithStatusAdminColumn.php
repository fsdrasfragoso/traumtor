<?php

namespace App\Models\Concerns;

trait WithStatusAdminColumn
{

    /**
     * Get status admin column
     *
     * @return string
     */
    public function getStatusAdminColumn($export = false)
    {
        if ($export) {
            return modelAttribute(self::class, 'options.status.' . $this->status);
        }

        return '<span class="badge badge-status-' . $this->status . '">' . modelAttribute(
            self::class,
            'options.status.' . $this->status
        ) . '</span>';
    }
}
