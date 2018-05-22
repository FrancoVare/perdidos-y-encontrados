<?php

use Faker\Generator as Faker;
use App\Retiro;

$factory->define(Retiro::class, function (Faker $faker) {
    return [
            'nombre' => $faker->name,  
    		'tipoDoc' => 'DNI',  
    		'numeroDoc' => mt_rand(10000000, 99999999),   
    		'laboratorio_id' => $faker->numberBetween(1,7),   
    		'item_id' => $faker->numberBetween(1,120),     
    		'user_id' => 1,
            'email' => $faker->safeEmail,
            'foto_retiro' => 'seed/Malfurion.png',
            'created_at' => $faker->dateTimeInInterval('-1 months','+ 30 days')
    ];
});
