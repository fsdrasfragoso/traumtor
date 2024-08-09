<?php

use Faker\Generator as Faker;
use Spatie\Permission\Models\Role;

// @var \Illuminate\Database\Eloquent\Factory $factory
$factory->define(Role::class, function (Faker $faker) {
    return [
        'name' => 'initial',
        'guard_name' => 'users',
    ];
});

$factory->state(Role::class, 'Administrador', function (Faker $faker) {
    return [
        'name' => 'Administrador',
    ];
});
