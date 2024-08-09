<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as BaseFormRequest;

class FormRequest extends BaseFormRequest
{
    /**
     * Type of class being validated.
     *
     * @var string
     */
    protected $type = 'App\\Models\\Model';

    /**
     * Form params
     *
     * @return array
     */
    public function params()
    {
        return $this->all();
    }

    /**
     * Define nice names for attributes.
     *
     * @return array
     */
    public function attributes()
    {
        $niceNames = [];

        foreach ($this->rules() as $attribute => $rule) {
            $column = modelAttribute($this->type, $attribute);

            $column = str_replace('.*.', '--', $column);
            $column = str_replace('.*', '', $column);

            if (is_string($column)) {
                $niceNames[$attribute] = trans($column);
            }
        }

        return $niceNames;
    }
}
