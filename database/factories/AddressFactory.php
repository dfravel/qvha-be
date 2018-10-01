<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Address::class, function (Faker $faker) {
    return [
        'address_line_1' => $faker->streetAddress,
        'address_line_2' => $faker->secondaryAddress,
        'city' => $faker->city,
        'state' => $faker->stateAbbr,
        'zip' => $faker->postCode,
        'country' => $faker->country
    ];
});
