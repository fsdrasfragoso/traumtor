<?php

namespace App\Http\Requests\Checkout;

use App\Http\Requests\Checkout\Concerns\PaymentRules;
use App\Http\Requests\Checkout\Concerns\RegisterRules;
use App\Models\RenewalOfferPurchase;
use Illuminate\Validation\Rule;
use App\Http\Requests\FormRequest;

class StoreRenewalOfferPurchaseRequest extends FormRequest
{
    use RegisterRules,
        PaymentRules;

    /**
     * Type of class being validated.
     *
     * @var string
     */
    protected $type = RenewalOfferPurchase::class;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge($this->registerRules(), $this->paymentRules(), [
            'payment_method' => ['required', Rule::in(['payment_profile', 'credit_card', 'debit_card', 'bank_transfer'])],
            'installments' => ['required', 'integer'],
            'coupon_code' => [],
            'g-recaptcha-response' => ['required_if:captcha_status,1', 'captcha'],
        ]);
    }
}