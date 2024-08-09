<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class RectSize implements Rule
{
    private $message_type;
    private $attribute;
    private $value;

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $this->attribute = $attribute;
        $this->value = $value;

        if (!preg_match('/(\d+)x(\d+)/', $value, $size)) {
            $this->message_type = 'validation.box_size_invalid_format';
            return false;
        }

        $width = intval($size[1]);
        $height = intval($size[2]);
        if ($width == 0 || $height == 0) {
            $this->message_type = 'validation.box_size_invalid_size';
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans($this->message_type, [
            'attribute' => trans('validation.attributes.'.$this->attribute),
            'value' => $this->value,
        ]);
    }
}
