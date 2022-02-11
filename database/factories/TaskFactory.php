<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Task;
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

$factory->define(Task::class, function (Faker $faker) use ($factory) {
    return [
        'name' => $faker->name,
        'description' => $faker->text,
        'customer_id' => $factory->create(\App\Models\Customer::class)->id,
        'status' => $faker->randomElement([ Task::COMPLETED_STATUS, Task::ONGOING_STATUS ]),
    ];
});
