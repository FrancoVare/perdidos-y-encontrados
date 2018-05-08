<?php

use Faker\Generator as Faker;
use App\Item;

$factory->define(Item::class, function (Faker $faker) {
    return [
        'fechaEncontrado' => $faker->dateTimeThisYear,
    	'descripcion' => $faker->realText,
    	'materia_id' => $faker->numberBetween(1,3),
	    'laboratorio_id' => $faker->numberBetween(1,7),
	    'tag_id' => $faker->numberBetween(1,5),
	    'user_id' => 1
    ];
});
