<?php

namespace App\Http\Requests\Checkout;

use App\Http\Requests\Checkout\Concerns\PaymentRules;
use App\Http\Requests\Checkout\Concerns\RegisterRules;
use App\Http\Requests\FormRequest;
use App\Models\Subscription;
use Illuminate\Validation\Rule;

class StoreSubscriptionRequest extends FormRequest
{
    use RegisterRules,
        PaymentRules;

    /**
     * Type of class being validated.
     *
     * @var string
     */
    protected $type = Subscription::class;

    public function validationData()
    {
        return array_merge($this->all(), [
            'installments' => $this->input('installments', 1),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        /** @var \App\Models\Footballer $footballer */
        $footballer = footballer();

        return array_merge($this->registerRules(), $this->paymentRules(), [
            'payment_method' => [
                'required',
                Rule::in([
                    'payment_profile', 'credit_card', 'debit_card',
                    'bank_transfer', 'bank_transfer_profile', 'pix',
                ]),
            ],
            'installments' => ['required', 'integer'],
            'used_credits' => [
                'nullable',
                'integer',
                'min:0',
                'max:' . ($footballer ? $footballer->wallet() : '0'),
            ],
            'coupon_code' => [],
            'g-recaptcha-response' => ['required_if:captcha_status,1', 'captcha'],
        ]);
    }

    public function messages()
    {
        return [
            'max' => 'O valor ultrapassou o limite.',
        ];
    }
}
