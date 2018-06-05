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

$factory->define(App\Item::class, function (Faker $faker) {

    return [
        'client_id'=> 1,
        'product_id'=> 1,
        'amount'=> 1,
        'is_paid'=> 0,
        'total'=> $faker->randomFloat,
    ];
});
