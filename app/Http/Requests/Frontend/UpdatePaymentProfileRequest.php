<?php

namespace App\Http\Requests\Frontend;

use App\Http\Requests\FormRequest;
use App\Libraries\PaymentGateway\CreditCard;
use App\Models\PaymentProfile;

class UpdatePaymentProfileRequest extends FormRequest
{
    /**
     * Type of class being validated.
     *
     * @var string
     */
    protected $type = PaymentProfile::class;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'holder' => ['required', 'max:255'],
            'serial' => ['required', 'creditcard', 'regex:' . CreditCard::getFlagRegexByName($this->input('flag'))],
            'flag' => ['required', 'in:' . CreditCard::flagOptions()->keys()->implode(',')],
            'cvv' => ['required', 'regex:/^[0-9]{3,4}$/'],
            'month' => [
                'required',
                'integer',
                'in:' . CreditCard::monthOptions()->keys()->implode(','),
                function ($attribute, $value, $fail) {
                    $current_date =  now();
                    $card_invalid = $this->input('year') < $current_date->year
                        || $this->input('year') <= $current_date->year
                        && $value < $current_date->month;

                    if ($card_invalid) {
                        $fail('O campo Mês de validade selecionado é inválido');
                    }
                }
            ],
            'year' => ['required', 'integer', 'in:' . CreditCard::yearOptions()->keys()->implode(',')],
        ];
    }
}
