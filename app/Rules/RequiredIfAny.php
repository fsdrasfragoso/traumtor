<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class RequiredIfAny implements Rule
{
    protected $message;
    protected $attributes;
    protected $values;
    protected $value;

    public function __construct($request, $attributes)
    {
        $this->attributes = $attributes;
        $this->values = $this->getValuesFromAttributes($request, $attributes);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $this->value = $value;
        return !$value || ($value && !$this->allNull($this->values));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.required_if_any', [
            'value' => $this->value,
            'values' => implode(", ", $this->getTransAttributes())
        ]);
    }

    protected function getValuesFromAttributes($request, $attributes)
    {
        $values = [];
        foreach($attributes as $attribute) {
            $values[] = $request->input($attribute);
        }
        return $values;
    }

    protected function allNull($array) {
        foreach ($array as $key => $value) if (!is_null( $value)) return false;
        return true;
    }

    protected function getTransAttributes()
    {
        $trans = function($attribute) {
            return trans('models.default.attributes.'.$attribute);
        };
        return array_map($trans, $this->attributes);
    }
}
