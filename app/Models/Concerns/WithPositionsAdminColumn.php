<?php

namespace App\Models\Concerns;

trait WithPositionsAdminColumn {

    /**
     * Get positions admin column
     *
     * @param bool $export
     * @return mixed|string
     */
    public function getPositionsAdminColumn($export = false)
    {
        if ($this->positions) {
            $positions = $this->positions->pluck('name')->implode(', ');

            if ($export) {
                return $positions;
            }

            $links = $this->positions->map(function ($position) {
                return html()->a(route('web.admin.positions.edit', $position), $position->name)->toHtml();
            })->implode(', ');

            return $links;
        }

        return '';
    }
}
