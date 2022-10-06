<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'product_id' => 'S' . $faker->numerify('#########'),
        'product_name' => $faker->name,
        'product_price' => $faker->numerify('###'),
        'description' => $faker->text,
    ];
});
