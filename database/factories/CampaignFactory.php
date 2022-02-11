<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Campaign;
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

$factory->define(Campaign::class, function (Faker $faker) use ($factory) {
    return [
        'name' => $faker->name,
        'description' => $faker->text,
        'target' => $faker->randomNumber(2),
        'budget' => $faker->randomNumber(4),
        'customer_id' => $factory->create(\App\Models\Customer::class)->id,
        'status' => $faker->randomElement([ Campaign::COMPLETED_STATUS, Campaign::ONGOING_STATUS ]),
    ];
});
