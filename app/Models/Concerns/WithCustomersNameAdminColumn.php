<?php

namespace App\Models\Concerns;

trait WithFootballersNameAdminColumn {

    /**
     * Get footballers name admin column
     *
     * @param bool $export
     * @return mixed|string
     */
    public function getFootballersNameAdminColumn($export = false)
    {
        if($this->footballer) {
            if ($export) {
                return $this->footballer->name;
            }

            return html()->a(route('web.admin.footballers.show', $this->footballer), $this->footballer->name)->data('pjax', true);
        }

        return null;
    }
}