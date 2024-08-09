<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class EmailBlockVerifier implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $blocks = old('blocks', settings('blocks') ?: []);

        foreach ($blocks as $email) {
            if (strpos($value, $email['email']) !== false) {
                return false;
            }
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
        return trans('validation.block_email');
    }
}
