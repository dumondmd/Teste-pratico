<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Veiculo;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(Veiculo::class, function (Faker $faker) {
    return [     
        'placa' => $faker->name,
        'renavam' => $faker->name,
        'modelo' => $faker->name,
        'marca' => $faker->name,
        'ano' => $faker->numberBetween(2000,2020),
        'proprietario' => $faker->numberBetween(1,50)                                                                
    ];
});