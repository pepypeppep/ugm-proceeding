<?php

use Faker\Generator as Faker;

$factory->define(App\ArticleIdentifier::class, function (Faker $faker) {
    return [
        'type' => $faker->randomElement(['doi', 'isbn']),
        'code' => $faker->isbn13,
    ];
});
