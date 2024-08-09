<?php

namespace App\Models\Concerns;

trait WithModalitiesAdminColumn {

    /**
     * Get modalities admin column
     *
     * @param bool $export
     * @return mixed|string
     */
    public function getModalitiesAdminColumn($export = false)
    {
        if ($this->modalities) {
            $modalities = $this->modalities->pluck('name')->implode(', ');

            if ($export) {
                return $modalities;
            }
            
            $links = $this->modalities->map(function ($modality) {                
                return html()->a(route('web.admin.modalities.edit', $modality), $modality->name)->toHtml();
            })->implode(', ');
            
            return $links;
        }

        return '';
    }
}
