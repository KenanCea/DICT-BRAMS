<?php

use App\HealthFacilities;
use Faker\Generator as Faker;

$factory->define(HealthFacilities::class, function (Faker $faker) {
    return [
        'barangay_id' => $faker->numberBetween(1, App\Barangay::count()),
        'pubhos_num' => $faker->randomDigit(),
        'pubhos_numpatients' => $faker->randomDigit(),
        'prihos_num' => $faker->randomDigit(),
        'prihos_numpatients' => $faker->randomDigit(),
        'healthcenter_num' => $faker->randomDigit(),
        'healthcenter_numpatients' => $faker->randomDigit(),
        'clinic_num' => $faker->randomDigit(),
        'clinic_numpatients' => $faker->randomDigit(),
        'self_medication_num' => $faker->randomDigit(),
        'self_medication_numpatients' => $faker->randomDigit(),
        'otherSpecify' => $faker->sentence(10),
    ];
});
