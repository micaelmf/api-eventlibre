<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Sponsor;
use Faker\Generator as Faker;

$factory->define(Sponsor::class, function (Faker $faker) {
    $indexType = rand(1,3);
    $type = array (1 => 'Apoio',2 => 'Patrocínio',3 => 'Realizaçao');
    return [
        'name' => $faker->company,
        'type' => $type[$indexType],
        'image' => $faker->image($dir = '/tmp', $width = 640, $height = 480),
        'event_id' => $faker->numberBetween($min=1, $max=3),
    ];
});
