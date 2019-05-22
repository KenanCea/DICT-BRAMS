<?php

use App\Barangay;
use Faker\Generator as Faker;

$factory->define(Barangay::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, App\User::count()),
        'province' =>$faker->randomElement(['Benguet']),
        'municipality'=>$faker->randomElement(['Baguio']),
        'region' =>$faker->randomElement(['CAR']),
        'zip_code'=>$faker->randomElement(['2600']),
        'legal_basis' =>$faker->sentence(10),
        'date_legal_basis' =>$faker->date,
        'date_ratification' =>$faker->date,
        'type_barangay' => $faker->randomElement(['Rural', 'Urban', 'Tribal']),
        'boundaries_north' => $faker-> numberBetween($min = 1000, $max = 20000),
        'boundaries_east' => $faker-> numberBetween($min = 1000, $max = 20000),
        'boundaries_west' => $faker-> numberBetween($min = 1000, $max = 20000),
        'boundaries_south' => $faker-> numberBetween($min = 1000, $max = 20000),
        'totalland_area_sqkm' => $faker-> numberBetween($min = 1000, $max = 20000),
        'totalland_area_hec' => $faker-> numberBetween($min = 1000, $max = 20000),
        'distance_municipal_city' => $faker-> numberBetween($min = 1000, $max = 20000),
        'province_capitol' => $faker-> numberBetween($min = 1000, $max = 20000),
        'national_highway' => $faker-> numberBetween($min = 1000, $max = 20000),
        'mountainous' => $faker->randomElement(['0-25%','26-50%','51-75%','76-100%']),
        'plain' => $faker->randomElement(['0-25%','26-50%','51-75%','76-100%']),
        'valley' => $faker->randomElement(['0-25%','26-50%','51-75%','76-100%'])
    ];
});
