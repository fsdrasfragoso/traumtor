<?php

use App\Models\Footballer;
use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Footballer::class, function (Faker $faker) {
    $firstName = $faker->firstName;
    $lastName = $faker->lastName;

    return [
        'name' => implode(' ', [$firstName, $lastName]),
        'first_name' => $firstName,
        'last_name' => $lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});
$factory->afterCreating(Footballer::class,function($footballer){
    factory(\App\Models\Profile::class)->create(['footballer_id' => $footballer->id]);
});

$factory->state(Footballer::class, 'johndoe', [
    'name' => 'John Doe',
    'first_name' => 'John',
    'last_name' => 'Doe',
    'email' => 'johndoe@example.com',
]);
