<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Speaker;
use Faker\Generator as Faker;

$factory->define(Speaker::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'job' => $faker->jobTitle,
        'bio' => $faker->sentence($nbWords = 12, $variableNbWords = true),
        'photo' => $faker->image($dir = '/tmp', $width = 640, $height = 480),
        'link_github' => $faker->url,
        'link_linkedin' => $faker->url,
        'link_medium' => $faker->url,
        'link_instagram' => $faker->url,
        'link_twitter' => $faker->url,
        'link_facebook' => $faker->url,
        'link_youtube' => $faker->url,
        'user_id' => $faker->numberBetween($min=1, $max=420),
    ];
});

$factory->afterCreating(Speaker::class, function ($row, $faker) {
    $row->events()->attach($faker->numberBetween($min=1, $max=3));
});
