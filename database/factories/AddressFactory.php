<?php

use App\Models\Address;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

// @var \Illuminate\Database\Eloquent\Factory $factory
$factory->define(Address::class, function (Faker $faker) {
    return [
        'street' => $faker->streetAddress,
        'number' => $faker->numberBetween(0, 10),
        'neighborhood' => $faker->streetName,
        'complement' => $faker->sentence(),
        'zip_code' => '59078-220',
        'city' => 'Natal',
        'city_code' => 2408102,
        'state' => 'RN',
    ];
});

$factory->state(Address::class, 'rits', [
    'street' => 'Avenida das Tulipas',
    'number' => '1849',
    'neighborhood' => 'Capim Macio',
    'complement' => 'Mobister',
    'zip_code' => '59078-220',
    'city' => 'Natal',
    'city_code' => 2408102, // Natal
    'state' => 'RN',
]);
