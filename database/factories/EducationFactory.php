<?php

use App\Education;
use Faker\Generator as Faker;

$factory->define(Education::class, function (Faker $faker) {
    return [
        'barangay_id' => $faker->numberBetween(1, App\User::count()),
        'no_pre_school_building' => $faker->numberBetween($min = 1, $max = 10),
        'no_primary_building' => $faker->numberBetween($min = 1, $max = 10),
        'no_secondary_building'=> $faker->numberBetween($min = 1, $max = 10),
        'no_vocational_building'=> $faker->numberBetween($min = 1, $max = 10),
        'no_college_building'=> $faker->numberBetween($min = 1, $max = 10),
        'no_post_graduate_building'=> $faker->numberBetween($min = 1, $max = 10),
        'no_covered_courts'=> $faker->numberBetween($min = 1, $max = 10),
        'no_gymnasiums'=> $faker->numberBetween($min = 1, $max = 10),
        'no_parks_plaza'=> $faker->numberBetween($min = 1, $max = 10),
        'others_sport_facilities'=> $faker->numberBetween($min = 1, $max = 10),
        'recreational_activities'=> $faker->numberBetween($min = 1, $max = 10),
        'total_facilities'=> $faker->numberBetween($min = 1, $max = 10),
    ];
});
