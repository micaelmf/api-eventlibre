<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Event;
use App\Model;
use Faker\Generator as Faker;

$factory->define(Event::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'about' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'period' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'image' => $faker->image($dir = '/tmp', $width = 640, $height = 480),
        'link_photos' => $faker->url,
        'link_registrations' => $faker->url,
        'edition' => $faker->randomNumber($nbDigits = 2, $strict = false),
        'data_start_event' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'data_end_event' => $faker->date($format = 'Y-m-d', $max = NULL),
        'data_start_registrations' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'data_end_registrations' => $faker->date($format = 'Y-m-d', $max = NULL),
    ];
});
