<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Model\User::class, function (Faker $faker) {
    return [
        'nombre' => $faker->name,
        'apellido' => $faker->lastname,
        'email' => $faker->unique()->safeEmail,
        'remember_token' => str_random(10),
        'active' => true,
        'domicilio' => $faker->address,
        'ciudad' => $faker->cityPrefix,
        'contacto_emergencia' => $faker->tollFreePhoneNumber,
        'telefono' => $faker->tollFreePhoneNumber,
        'seguro_social' => $faker->ssn,
    ];
});
