<?php

use Faker\Generator as Faker;

$factory->define(App\Member::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'family_name' => $faker->lastName,
        'middle_name' => $faker->lastName,
        'age' => '20', 
        'sex' => ('male'),
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
