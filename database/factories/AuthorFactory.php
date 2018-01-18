<?php

use Faker\Generator as Faker;

$factory->define(App\Author::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'affiliation' => $faker->company,
        'email' => $faker->unique()->safeEmail,
    ];
});
