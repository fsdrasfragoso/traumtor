<?php

namespace App\Models\Concerns;

trait WithFootballersEmailAdminColumn {

    /**
     * Get footballers email admin column
     *
     * @param bool $export
     * @return mixed|string
     */
    public function getFootballersEmailAdminColumn($export = false)
    {
        if($this->footballer) {
            if ($export) {
                return $this->footballer->email;
            }

            return html()->a(route('web.admin.footballers.show', $this->footballer), $this->footballer->email)->data('pjax', true);
        }

        return null;
    }
}