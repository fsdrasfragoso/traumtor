<?php

namespace App\Models\Concerns;

trait WithCreatedAtAdminColumn
{
    /**
     * Get created at admin column.
     *
     * @return string
     */
    public function getCreatedAtAdminColumn()
    {
        return $this->created_at->format(config('admin.timestamp_format'));
    }

    public function getCreatedAtAdminColumnClass()
    {
        return 'text-center shrink-wrap';
    }

    /**
     * Get updated at admin column.
     *
     * @return string
     */
    public function getUpdatedAtAdminColumn()
    {
        return $this->updated_at->format(config('admin.timestamp_format'));
    }

    public function getUpdatedAtAdminColumnClass()
    {
        return 'text-center shrink-wrap';
    }

    /**
     * Get deleted at admin column.
     *
     * @return string
     */
    public function getDeletedAtAdminColumn()
    {
        return $this->deleted_at ? '<span class="text-danger">' . $this->deleted_at->format(config('admin.timestamp_format')) . '</span>' : '';
    }

    public function getDeletedAtAdminColumnClass()
    {
        return 'text-center shrink-wrap';
    }
}
