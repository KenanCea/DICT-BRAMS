<?php

use App\Communication;
use Faker\Generator as Faker;

$factory->define(Communication::class, function (Faker $faker) {
    return [
        'barangay_id' => $faker->numberBetween(1, App\Barangay::count()),
        'telephone_totalProvider' => $faker->randomDigit(),
        'telephone_name_company' => $faker->randomElement(['PLDT','Globe','Smart','Sky']),
        'telephone_no_hhold_served' => $faker->randomDigit(),
        'cellular_totalProvider' => $faker->randomDigit(),
        'cellular_name_company' => $faker->randomElement(['Smart','Globe','Sun']),
        'cellular_no_hhold_served' => $faker->randomDigit(),
        'internet_totalProvider' => $faker->randomDigit(),
        'internet_name_company' => $faker->randomElement(['PLDT','Globe','Smart','Sky']),
        'internet_no_hhold_served' => $faker->randomDigit(),
        'postalservive_totalProvider' => $faker->randomDigit(),
        'postalservive_name_company' => $faker->randomElement(['Philippine Postal Corporation']),
        'postalservive_no_hhold_served' => $faker->randomDigit(),
        'deliveryservice_totalProvider' => $faker->randomDigit(),
        'deliveryservice_name_company' => $faker->randomElement(['LBC']),
        'deliveryservice_no_hhold_served' => $faker->randomDigit(),
    ];
});
