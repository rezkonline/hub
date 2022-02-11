<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Transaction;
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

$factory->define(Transaction::class, function (Faker $faker) use ($factory) {
    return [
        'customer_id' => $factory->create(\App\Models\Customer::class)->id,
        'actor_id' => $factory->create(\App\Models\Admin::class)->id,
        'amount' => $faker->randomNumber(3),
        'payment_type' => 'PayPal',
        'note' => $faker->text(10),
        'type' => $faker->randomElement([Transaction::PACKAGE_TYPE, null]),
    ];
});
