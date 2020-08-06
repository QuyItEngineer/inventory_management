<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Product::class, function (Faker $faker) {
    return [
        'unique_code' => $faker->numberBetween(100, 1000),
        'name' => $faker->name,
        'quantity' => 50,
        'input_price' => 50000,
        'price' => 100000,
        'wholesale_price' => 70000,
        'retail_price' => 70000
    ];
});
