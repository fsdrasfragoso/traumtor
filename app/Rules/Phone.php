<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;


class Phone implements Rule
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
        $ddds = [11, 12, 13, 14, 15, 16, 17, 18, 19, 21, 22, 24, 27, 28, 31, 32, 33, 34, 35, 37, 38, 41, 42, 43, 44, 45, 46, 47, 48, 49, 51, 53, 54, 55, 61, 62, 63, 64, 65, 66, 67, 68, 69, 71, 73, 74, 75, 77, 79, 81, 82, 83, 84, 85, 86, 87, 88, 89, 91, 92, 93, 94, 95, 96, 97, 98, 99];

        if(preg_match('/^\([0-9]{2}\) (9[0-9]{4}|[0-9]{4})-[0-9]{4}$/', $value) > 0) {
            $start = substr($value, 1, 2);
            $end = substr($value, 5);

            if(!in_array($start, $ddds)) {
                return false;
            }

            if($end == '1234-5678' || $end == '0000-0000' || $end == '00000-0000') {
                return false;
            }

            for($i=0; $i <= 9; $i++) {
                if($end == str_repeat($i, 5) . '-' . str_repeat($i, 4)) {
                    return false;
                }
            }

            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.phone');
    }
}
