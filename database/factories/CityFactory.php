<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\City;
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

$factory->define(City::class, function (Faker $faker) use ($factory) {
    return [
        'name' => $faker->city,
        'country_id' => $factory->create(\App\Models\Country::class)->id,
    ];
});
