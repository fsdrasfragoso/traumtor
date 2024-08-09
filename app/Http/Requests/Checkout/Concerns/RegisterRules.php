<?php

namespace App\Http\Requests\Checkout\Concerns;

use App\Rules\Document;
use App\Rules\EmailBlockVerifier;
use App\Rules\Phone;
use Illuminate\Validation\Rule;

trait RegisterRules
{
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
     * Register rules.
     *
     * @return array
     */
    public function registerRules()
    {
        $footballer = footballer();

        if ($footballer) {
            return [];
        }

        return [
            'name' => ['required', 'string', 'max:255'],
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
