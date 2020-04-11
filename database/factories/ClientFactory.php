<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Client::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'phone_number_1' => 1234567890,
        'phone_number_2' => 1234567890,
        'address' => $faker->address,
        'car_group_type' => $faker->name,
        'shipping_type' => 'moto'
    ];
});
