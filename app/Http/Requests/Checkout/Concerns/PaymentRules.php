<?php

namespace App\Http\Requests\Checkout\Concerns;

use App\Libraries\PaymentGateway\CreditCard;

trait PaymentRules
{
    /**
     * Payment rules.
     *
     * @return array
     */
    public function paymentRules()
    {
        $payment_method = $this->input('payment_method');

        if (in_array($payment_method, [
            'payment_profile', 'bank_split', 'pix',
        ])) {
            return [];
        }

        return [
            'holder' => ['required', 'max:255'],
            'serial' => ['required', 'regex:' . CreditCard::getFlagRegexByName($this->input('flag'))],
            'flag' => ['required', 'in:' . CreditCard::flagOptions()->keys()->implode(',')],
            'cvv' => ['required', 'regex:/^[0-9]{3,4}$/'],
            'month' => ['required', 'integer', 'in:' . CreditCard::monthOptions($this->input('year'))->keys()->implode(',')],
            'year' => ['required', 'integer', 'in:' . CreditCard::yearOptions()->keys()->implode(',')],
        ];
    }
}
