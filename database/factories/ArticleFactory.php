<?php

use Faker\Generator as Faker;

$factory->define(App\Article::class, function (Faker $faker) {
    return [
    	'proceeding_id' => 1,
        'title' => $faker->sentence($faker->numberBetween(6, 10), true),
        'abstract' => $faker->paragraph(10, true),
        'keywords' => $faker->word.','.$faker->word.','.$faker->word,
        'end_page' => 26,
        'start_page' => 13,
        'file' => 'https://jurnal.ugm.ac.id/ijc/article/download/25097/18730',
    ];
});
