<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Customer;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'customer_name' => $faker->name,
        'email' => preg_replace('/@example\..*/', '@domain.com', $faker->unique()->safeEmail),
        'tel_num' => $faker->numerify('##########'),
        'address' => $faker->text,
    ];
});
