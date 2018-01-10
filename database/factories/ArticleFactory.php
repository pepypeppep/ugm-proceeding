<?php

use Faker\Generator as Faker;

$factory->define(App\Article::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence($faker->numberBetween(6, 10), true),
        'abstract' => $faker->paragraph(6, true),
        'keywords' => $faker->word.','.$faker->word.','.$faker->word,
        'end_page' => 26,
        'start_page' => 13,
    ];
});
