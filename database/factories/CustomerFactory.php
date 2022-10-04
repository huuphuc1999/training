<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Customer;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'customer_name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'tel_num' => $faker->numerify('##########'),
        'address' => $faker->text,
    ];
});
