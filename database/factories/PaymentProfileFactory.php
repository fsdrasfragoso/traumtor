<?php

// @var $factory \Illuminate\Database\Eloquent\Factory

use App\Libraries\PaymentGateway\CreditCard;
use App\Libraries\PaymentGateway\PaymentGateway;
use App\Models\PaymentProfile;
use Faker\Generator as Faker;

$factory->define(PaymentProfile::class, function (Faker $faker) {
    return [
        'payment_gateway' => PaymentGateway::PAYMENT_GATEWAY_ASAAS,
        'holder' => $faker->name,
        'serial' => '4444444444444448',
        'flag' => CreditCard::FLAG_VISA,
        'cvv' => '123',
        'month' => (int) now()->addMonth()->format('m'),
        'year' => now()->addYear()->year,
    ];
});
