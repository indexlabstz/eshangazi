<?php

use Faker\Generator as Faker;

$factory->define(App\PartnerCategory::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->paragraph,
    ];
});
