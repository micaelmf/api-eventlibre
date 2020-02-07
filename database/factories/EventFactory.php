<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Event;
use App\Model;
use App\Participant;
use Faker\Generator as Faker;

$factory->define(Event::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'about' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'period' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'image' => $faker->image($dir = '/tmp', $width = 640, $height = 480),
        'link_photos' => $faker->url,
        'link_registrations' => $faker->url,
        'edition' => $faker->randomNumber($nbDigits = 2, $strict = false),
        'date_start_event' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'date_end_event' => $faker->date($format = 'Y-m-d', $max = NULL),
        'date_start_registrations' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'date_end_registrations' => $faker->date($format = 'Y-m-d', $max = NULL),
        'user_id' => $faker->numberBetween($min=1, $max=420),
        'address_id' => $faker->numberBetween($min=1, $max=3),
    ];
});

$factory->afterCreating(Event::class, function ($row, $faker) {
    $row->participants()->attach($faker->numberBetween($min=1, $max=20));
});
