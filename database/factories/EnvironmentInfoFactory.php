<?php

use App\EnvironmentInfo;
use Faker\Generator as Faker;

$factory->define(EnvironmentInfo::class, function (Faker $faker) {
    return [
        'household_id' => $faker->numberBetween(1, App\Household::count()),
        'Level1' => $faker->randomElement(['Spring','Deepwell public','Deepwell private']),
        'Level2' => $faker->randomElement(['Public Faucet','Box Spring']),
        'Level3' => $faker->randomElement(['Piped(in house)','Piped(public)']),
        'tank' => $faker->randomElement(['y','n']),
        'elevated_tank' => $faker->randomElement(['y','n']),
        'jars'=> $faker->randomElement(['y','n']),
        'drums_cans' => $faker->randomElement(['y','n']),
        'plastic_conatainers' => $faker->randomElement(['y','n']),
        'others_water_storage' => $faker->sentence(),
        'market' => $faker->randomElement(['y','n']),
        'sarisaristore' => $faker->randomElement(['y','n']),
        'ambulant_vendor' => $faker->randomElement(['y','n']),
        'others_food_service' => $faker->sentence(),
        'refrigerator' => $faker->randomElement(['y','n']),
        'cabinet_shelves' => $faker->randomElement(['y','n']),
        'others_hhold_storage' => $faker->sentence(),
        'fresh' => $faker->randomElement(['y','n']),
        'dried' => $faker->randomElement(['y','n']),
        'processed' => $faker->randomElement(['y','n']),
        'others_kind_of_foodstorage' => $faker->sentence(),
        'with' => $faker->randomElement(['Flush with Septic','Flush with sewer','Water sealed(pit)','Pit Privy']),
        'drainage' => $faker->randomElement(['W/o drainage','Open drainage','Blind drainage']),
        'city_mun_collection' => $faker->randomElement(['y','n']),
        'communal_pit' => $faker->randomElement(['y','n']),
        'backyard_pit' => $faker->randomElement(['y','n']),
        'open_dump' => $faker->randomElement(['y','n']),
        'composting' => $faker->randomElement(['y','n']),
        'burning' => $faker->randomElement(['y','n']),
        'others_garbage_disposal' => $faker->sentence(),
    ];
});
