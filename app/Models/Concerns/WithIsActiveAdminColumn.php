<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;

trait WithIsActiveAdminColumn
{
    /**
     * Get is_active admin column.
     *
     * @return string
     */
    public function getIsActiveAdminColumn()
    {
        return '<span class="badge badge-' . ($this->is_active ? 'success' : 'gray-400') . '">' . modelAttribute(
            self::class,
            'options.boolean.' . ($this->is_active ? 1 : 0)
        ) . '</span>';
    }

    /**
     * Get is_active admin column class.
     * @return string
     */
    public function getIsActiveAdminColumnClass()
    {
        return 'text-center';
    }

    public function getIsActiveExportColumn()
    {
        return modelAttribute(self::class, 'options.boolean.' . ($this->is_active ? 1 : 0));
    }

    /**
     * Scope active.
     *
     * @param Builder $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where($this->getTable() . '.is_active', true);
    }
}
