<?php

namespace App\Http\Controllers\Admin\Concerns;

use App\Http\Requests\FormRequest;

trait HasForm
{
    /**
     * Returns the request that should be used to validate.
     *
     * @return FormRequest
     */
    protected function formRequest()
    {
        return request();
    }

    /**
     * Attributes to fill on model.
     *
     * @return array
     */
    public function formParams()
    {
        return $this->formRequest()->params();
    }
}
