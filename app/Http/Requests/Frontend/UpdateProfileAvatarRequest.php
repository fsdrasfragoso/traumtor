<?php

namespace App\Http\Requests\Frontend;

use App\Http\Requests\FormRequest;
use App\Models\Footballer;

class UpdateProfileAvatarRequest extends FormRequest
{
    /**
     * Type of class being validated.
     *
     * @var string
     */
    protected $type = Footballer::class;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'avatar' => ['image'],
        ];
    }
}