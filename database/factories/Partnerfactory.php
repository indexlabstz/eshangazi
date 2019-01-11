<?php

use Faker\Generator as Faker;

$factory->define(App\Partner::class, function (Faker $faker) {
    return [
            'name'          => $faker->name,
            'bio'           => $faker->paragraph,
            'category_id'   => function() { return factory(App\PartnerCategory::class)->create()->id; },
            'phone'         => 072324525256,
            'email'         => $faker->unique()->safeEmail,
            'address'       => $faker->address
    ];
});
