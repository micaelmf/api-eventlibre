<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Participant;
use Faker\Generator as Faker;

$factory->define(Participant::class, function (Faker $faker) {
    return [
        'fullname' => $faker->name,
        'nickname' => $faker->userName,
        'photo' => $faker->image($dir = '/tmp', $width = 640, $height = 480),
        'user_id' => $faker->numberBetween($min=1, $max=420),
    ];
});
