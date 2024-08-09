<?php

namespace App\Models\Concerns;

use Illuminate\Support\Facades\Route;

trait WithReferenceAdminColumn {

    /**
     * Get reference admin column
     *
     * @return string
     */
    public function getReferenceAdminColumn($export = false)
    {
        if($export) {
            return $this->reference_type.':'.$this->reference_id;
        }

        $html = '';
        if (is_null($this->reference)) {
            $html .= modelAction($this->reference_type, 'label');
        } elseif (Route::has('web.admin.' . $this->reference->getTable() . '.show')) {
            $html .= html()->a(route('web.admin.'.$this->reference->getTable().'.show', [$this->reference]),
                modelAction(get_class($this->reference), 'label').' #'.$this->reference_id);
        } elseif (Route::has('web.admin.' . $this->reference->getTable() . '.edit')) {
            $html .= html()->a(route('web.admin.' . $this->reference->getTable() . '.edit', [$this->reference]), modelAction(get_class($this->reference), 'label') . ' #'.$this->reference_id);
        } else {
            $html .= modelAction(get_class($this->reference), 'label') . ' #' . $this->reference_id;
        }

        return $html;
    }
}
