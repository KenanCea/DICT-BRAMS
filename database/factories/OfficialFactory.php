<?php

use App\Official;
use Faker\Generator as Faker;

$factory->define(Official::class, function (Faker $faker) {
    return [
        'user_id'=>App\User::all()->random()->id,
        'position' => $faker->randomElement(['Punong Barangay','Barangay Kagawad', 'Barangay Secretary', 'Barangay Treasurer']),
        'name' => $faker->name,
        'start_term' => $faker->date,
        'end_term' => $faker->date,
    ];
});
