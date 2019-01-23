<?php

use Faker\Generator as Faker;

$factory->define(App\Anuncio::class, function (Faker $faker) {
    return [
        'producto'              => $faker->name,
        'id_categoria'      => $faker->randomElement([1, 2, 3]),
        'precio'            => $faker->randomElement([10, 50, 100]),
        'nuevo'             => $faker->randomElement([0, 1]),
        'descripcion'       => $faker->paragraph,
        'id_vendedor'       => \App\User::all()->random()->id,
        'vendido'           => $faker->randomElement([0, 1]),

    ];
});
