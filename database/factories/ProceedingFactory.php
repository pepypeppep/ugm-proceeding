<?php

use Faker\Generator as Faker;

$factory->define(App\Proceeding::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(4, true),
        'alias' => $faker->bothify('IC## 201?'),
        'front_cover' => $faker->imageUrl(344, 550, 'technics'),
        'back_cover' => $faker->imageUrl(344, 550, 'technics'),
        'isbn' => $faker->isbn13,
        'organizer' => $faker->company,
    ];
});