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

$factory->define(App\Client::class, function (Faker $faker) {

    return [
        'name' => $faker->name,
        'surname' => $faker->name,
        'phone_number' => null,
        'setor' => $faker->name,
        'total' => $faker->randomFloat,
        'user_id' => function() {
          return factory(App\User::class)->create()->id;
        },
    ];
});
