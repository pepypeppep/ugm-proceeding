<?php

use Faker\Generator as Faker;

$factory->define(App\Editor::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
