<?php

use Faker\Generator as Faker;

$factory->define(App\Member::class, function (Faker $faker) {
    return [
        'first_name' => $faker->name,
        'family_name' => $faker->name,
        'middle_name' => $faker->name,
        'age' => '20', 
        'sex' => ('male'),
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
