<?php

namespace App\Http\Requests\Frontend\Auth;

use App\Http\Requests\FormRequest;
use App\Models\Footballer;
use App\Rules\Document;
use App\Rules\EmailBlockVerifier;
use App\Rules\Phone;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    /**
     * Type of class being validated.
     *
     * @var string
     */
    protected $type = Footballer::class;

    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    public function validationData()
    {
        $data = $this->all();

        $email = strtolower(data_get($data, 'email'));
        data_set($data, 'email', $email);

        return $data;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'regex:/^\pL+\s+\pL+.*$/u', 'string', 'min:1', 'max:255'],
            'email' => ['required', new EmailBlockVerifier(), 'string', 'email', 'max:255', Rule::unique('footballers', 'email')->whereNull('deleted_at')],
            'password' => ['required', 'min:8', 'regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/'],
            'password_confirmation' => ['required', 'same:password'],
            'document' => ['required', 'regex:/^[0-9]{3}\.[0-9]{3}\.[0-9]{3}-[0-9]{2}$/', new Document(), Rule::unique('footballers', 'document')->whereNull('deleted_at')],
            'phone' => ['nullable', new Phone()],
            'zip_code' => ['required', Rule::notIn(['00000-000']), 'regex:/^[0-9]{5}-[0-9]{3}$/'],
            'street' => ['required', 'max:255'],
            'number' => ['required', 'max:9'],
            'neighborhood' => ['required', 'max:255'],
            'complement' => ['max:255'],
            'city' => ['required'],
            'state' => ['required'],
        ];
    }
}
