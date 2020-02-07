<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Address;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
    return [
        'name' => $faker->city,
        'map' => $faker->sentence($nbWords = 12, $variableNbWords = true),
        'street' => $faker->streetName,
        'number' => $faker->buildingNumber,
        'district' => $faker->word,
        'city' => $faker->city
    ];
});
