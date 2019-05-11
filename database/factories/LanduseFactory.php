<?php

use App\Landuse;
use Faker\Generator as Faker;

$factory->define(Landuse::class, function (Faker $faker) {
    return [
        'barangay_id' => $faker->numberBetween(1, App\Barangay::count()),
        'residential_land_area_sqm' => $faker->numberBetween($min = 10000, $max = 1000000),
        'residential_land_area_hec' => $faker->numberBetween($min = 10000, $max = 1000000),
        'residential_totalpop' => $faker->numberBetween($min = 10000, $max = 1000000),
        'commercial_land_area_sqm' => $faker->numberBetween($min = 10000, $max = 1000000),
        'commercial_land_area_hec' => $faker->numberBetween($min = 10000, $max = 1000000),
        'commercial_totalpop' => $faker->numberBetween($min = 10000, $max = 1000000),
        'industrial_land_area_sqm' => $faker->numberBetween($min = 10000, $max = 1000000),
        'industrial_land_area_hec' => $faker->numberBetween($min = 10000, $max = 1000000),
        'industrial_totalpop' => $faker->numberBetween($min = 10000, $max = 1000000),
        'agricultural_land_area_sqm' => $faker->numberBetween($min = 10000, $max = 1000000),
        'agricultural_land_area_hec' => $faker->numberBetween($min = 10000, $max = 1000000),
        'agricultural_totalpop' => $faker->numberBetween($min = 10000, $max = 1000000),
        'aquatic_land_area_sqm' => $faker->numberBetween($min = 10000, $max = 1000000),
        'aquatic_land_area_hec' => $faker->numberBetween($min = 10000, $max = 1000000),
        'aquatic_totalpop' => $faker->numberBetween($min = 10000, $max = 1000000),
        'forest_land_area_sqm' => $faker->numberBetween($min = 10000, $max = 1000000),
        'forest_land_area_hec' => $faker->numberBetween($min = 10000, $max = 1000000),
        'forest_totalpop' => $faker->numberBetween($min = 10000, $max = 1000000),
        'idle_land_area_sqm' => $faker->numberBetween($min = 10000, $max = 1000000),
        'idle_land_area_hec' => $faker->numberBetween($min = 10000, $max = 1000000),
        'idle_land_area_totalpop' => $faker->numberBetween($min = 10000, $max = 1000000),
        'total_no_hhold' => $faker->numberBetween($min = 10000, $max = 1000000),
        'ave_persons_hhold' => $faker->numberBetween($min = 10000, $max = 1000000),
        'ave_income_hhold' => $faker->numberBetween($min = 10000, $max = 1000000),
        'rank1_employment' =>$faker->sentence(10),
        'rank2_employment' =>$faker->sentence(10),
        'rank3_employment' =>$faker->sentence(10),
    ];
});
