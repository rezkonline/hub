<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Achievement;
use Illuminate\Support\Str;
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

$factory->define(Achievement::class, function (Faker $faker) use ($factory) {
    return [
        'title' => $faker->name,
        'value' => $faker->randomNumber(2),
        'customer_id' => $factory->create(\App\Models\Customer::class)->id,
    ];
});
