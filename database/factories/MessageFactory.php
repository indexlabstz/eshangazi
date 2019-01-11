<?php

use Faker\Generator as Faker;

$factory->define(App\Message::class, function (Faker $faker) {
    return [
        'title'         => $faker->sentence,
        'description'   => $faker->paragraph,
        'thumbnail'     => $faker->imageUrl,
        'status'        => 'draft',
        'gender'        => $faker->randomElement(['male', 'female']),
        'minimum_age'   => $faker->numberBetween(13, 100),
        'created_by'    => 1           
    ];  
});
