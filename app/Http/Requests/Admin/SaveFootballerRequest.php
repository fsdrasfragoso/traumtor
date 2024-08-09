<?php

namespace App\Http\Requests\Admin;

use App\Models\Footballer;
use App\Rules\Document;
use App\Rules\EmailBlockVerifier;
use App\Rules\Phone;
use Illuminate\Validation\Rule;

class SaveFootballerRequest extends CrudRequest
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
     * Rules when creating resource.
     *
     * @return array
     */
    protected function createRules()
    {
        return [
            'password' => ['required', 'min:8', 'regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/'],
            'password_confirmation' => ['required', 'same:password'],
            'zip_code' => ['required', Rule::notIn(['00000-000']), 'regex:/^[0-9]{5}-[0-9]{3}$/'],
            'street' => ['required', 'max:255'],
            'number' => ['required', 'max:9'],
            'neighborhood' => ['required', 'max:255'],
            'complement' => ['max:255'],
            'city' => ['required'],
            'state' => ['required'],
            'overall' => ['integer', 'between:1,99', 'required'],
            'height' => ['nullable', 'numeric', 'between:0,0', '99,99'],
            'weight' => ['nullable', 'numeric', 'between:0,0', '99,99'],
            'dominant_foot' => ['required', Rule::in(['right', 'left', 'ambidextrous'])],
        ];
    }

    /**
     * Rules when editing resource.
     *
     * @return array
     */
    protected function editRules()
    {
        return [
            'password' => ['min:8', 'regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/', 'nullable'],
            'password_confirmation' => ['same:password', 'nullable'],
            'overall' => ['integer', 'between:1,99', 'nullable'],
            'height' => ['nullable', 'numeric', 'between:0,0', '99,99'],
            'weight' => ['nullable', 'numeric', 'between:0,0', '99,99'],
            'dominant_foot' => ['nullable', Rule::in(['right', 'left', 'ambidextrous'])],
        ];
    }

    /**
     * Base rules for both creating and editing the resource.
     *
     * @return array
     */
    public function baseRules()
    {
        return [
            'name' => ['string', 'min:1', 'max:255'],
            'document' => ['required', 'regex:/^[0-9]{3}\.[0-9]{3}\.[0-9]{3}-[0-9]{2}$/', new Document(), Rule::unique('footballers', 'document')->ignore($this->route('id'))->whereNull('deleted_at')],
            'email' => ['required', 'email', 'max:255', Rule::unique('footballers', 'email')->ignore($this->route('id'))->whereNull('deleted_at'), new EmailBlockVerifier()],
            'phone' => ['required', 'string', new Phone()],
            'status' => ['string', 'in:active,inactive'],
            'email_verified_at' => ['nullable', 'date'],
        ];
    }
}
