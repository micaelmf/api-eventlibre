<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Activity;
use Faker\Generator as Faker;

$factory->define(Activity::class, function (Faker $faker) {
    
    $indexType = rand(1,4);
    $type = array (1 => 'Abertura',2 => 'Mesa Redonda',3 => 'Oficina', 4 => 'Talk');
    $indexLevel = rand(1,3);
    $level = array (1 => 'Básico',2 => 'Intermediário', 3 => 'Avançado');
    $indexLocal = rand(1,4);
    $local = array (1 => 'Auditório',2 => 'Sala1', 3 => 'Sala2', 4 => 'Sala3');
    $indexSpace = rand(1,4);
    $space = array (1 => 'Ada Lovelace',2 => 'Alan Turing', 3 => 'PHP', 4 => 'Vue.js');
    $indexStatus = rand(1,4);
    $status = array (1 => 'Alterada',2 => 'Cancelada', 3 => 'Aceita', 4 => 'Pendente');
    $indexHour = rand(1,8);
    $hour = array (1 =>'08:00:00', 2=>'09:00:00', 3=>'10:00:00', 4=>'11:00:00', 5=>'13:00:00', 6=>'14:00:00', 7=>'15:00:00', 8=>'16:00:00');
    return [
        'name' => $faker->word,
        'type' => $type[$indexType],
        'duration' => $faker->numberBetween($min=1, $max=8),
        'date' => $faker->date($format='Y-m-d', $max = 'now'),
        'hour' => $hour[$indexHour],
        'level' => $level[$indexLevel],
        'description' => $faker->sentence($nbWords = 16, $variableNbWords = true),
        'local' => $local[$indexLocal],
        'space' => $space[$indexSpace],
        'archive' => $faker->image($dir = '/tmp', $width = 640, $height = 480),
        'status' => $status[$indexStatus],
        'event_id' => $faker->numberBetween($min=1, $max=3),
        'speaker_id' => $faker->numberBetween($min=1, $max=10),
    ];
});

$factory->afterCreating(Activity::class, function ($row, $faker) {
    $row->participants()->attach(rand(1,20));
});