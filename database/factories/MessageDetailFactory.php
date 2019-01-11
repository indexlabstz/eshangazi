<?php

use Faker\Generator as Faker;

$factory->define(App\MessageDetail::class, function (Faker $faker) {
    return [
        'title'         => $faker->sentence,
        'description'   => $faker->paragraph,
        'thumbnail'     => $faker->imageUrl,
        'message_id'    => function() { 
            return factory(App\Message::class)->create(['created_by' => 1])->id; 
        },
    ];
});
