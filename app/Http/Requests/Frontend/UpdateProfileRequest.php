<?php

namespace App\Http\Requests\Frontend;

use App\Http\Requests\FormRequest;
use App\Models\Footballer;
use App\Rules\Document;
use App\Rules\EmailBlockVerifier;
use App\Rules\Phone;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
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
            'name' => ['required', 'regex:/^\pL+\s+\pL+.*$/u', 'string', 'min:1', 'max:255'],
            'email' => ['required', new EmailBlockVerifier(), 'email', 'max:255', Rule::unique('footballers', 'email')->ignore(footballer()->id, 'id')->whereNull('deleted_at')],
            'phone' => ['nullable', new Phone()],
            'zip_code' => ['required', Rule::notIn(['00000-000']), 'regex:/^[0-9]{5}-[0-9]{3}$/'],
            'street' => ['required'],
            'number' => ['required', 'max:9'],
            'neighborhood' => ['required'],
            'complement' => ['max:255'],
            'city' => ['required'],
            'state' => ['required'],
        ];
    }
}
