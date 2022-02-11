<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Message;
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

$factory->define(Message::class, function (Faker $faker) use ($factory) {
    return [
        'customer_id' => $factory->create(\App\Models\Customer::class)->id,
        'manager_id' => $factory->create(\App\Models\Supervisor::class)->id,
        'sender_id' => $factory->create(\App\Models\Supervisor::class)->id,
        'seen_by_manager' => $faker->boolean(50),
        'seen_by_customer' => $faker->boolean(50),
    ];
});
