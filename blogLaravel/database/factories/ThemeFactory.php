<?php

use Faker\Generator as Faker;

$factory->define(App\Theme::class, function (Faker $faker) {
	/*variable para que slug sea igual al nombre*/
	$nombre=$faker->unique()->word;
    return [
        'user_id' => 1, // solo el usuario con id 1 podrá crear un tema
        'nombre' => ucfirst($nombre),
        'slug' => $nombre,
        'destacado' => $faker->boolean(false),
        'suscripcion' => $faker->boolean(false),
    ];
});
