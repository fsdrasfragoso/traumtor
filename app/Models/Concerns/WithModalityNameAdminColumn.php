<?php

namespace App\Models\Concerns;

trait WithModalityNameAdminColumn {

    /**
     * Get modality name admin column
     *
     * @param bool $export
     * @return mixed|string
     */
    public function getModalityNameAdminColumn($export = false)
    {
        if ($this->modality) {
            if ($export) {
                return $this->modality->name;
            }

            return html()->a(route('web.admin.modalities.edit', $this->modality), $this->modality->name)->data('pjax', true);
        }

        return '';
    }
}
