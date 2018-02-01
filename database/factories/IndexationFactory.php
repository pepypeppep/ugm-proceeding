<?php

use Faker\Generator as Faker;

$factory->define(App\Indexation::class, function (Faker $faker) {
    return [
        'type' => collect(['scopus', 'doaj'])->random(),
        'link' => $faker->url,
    ];
});
