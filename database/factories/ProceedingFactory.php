<?php

use Faker\Generator as Faker;

$factory->define(App\Proceeding::class, function (Faker $faker) {
    return [
        'name' => $faker->words(4, true),
        'alias' => strtoupper($faker->bothify('IC?? 201#')),
        'conference_start' => '2017-10-12',
        'conference_end' => '2017-10-13',
        'location' => $faker->country,
        'introduction' => $faker->realText(500, 2),
        'front_cover' => $faker->imageUrl(344, 550, 'technics'),
        'back_cover' => $faker->imageUrl(344, 550, 'technics'),
        'organizer' => $faker->company,
    ];
});
