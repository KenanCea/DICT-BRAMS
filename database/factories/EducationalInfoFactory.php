<?php

use App\EducationalInfo;
use Faker\Generator as Faker;

$factory->define(EducationalInfo::class, function (Faker $faker) {
    return [
        'household_id' => $faker->numberBetween(1, App\Household::count()),
        'preschool_grad' => $faker->numberBetween($min = 1, $max = 10),
        'preschool_ugrad' => $faker->numberBetween($min = 1, $max = 10),
        'preschool_currently_enrolled' => $faker->numberBetween($min = 1, $max = 10),
        'prielem_grad' => $faker->numberBetween($min = 1, $max = 10),
        'prielem_ugrad' => $faker->numberBetween($min = 1, $max = 10),
        'prielem_currently_enrolled' => $faker->numberBetween($min = 1, $max = 10),
        'secondary_grad' => $faker->numberBetween($min = 1, $max = 10),
        'secondary_ugrad' => $faker->numberBetween($min = 1, $max = 10),
        'secondary_currently_enrolled' => $faker->numberBetween($min = 1, $max = 10),
        'vocational_grad' => $faker->numberBetween($min = 1, $max = 10),
        'vocational_ugrad' => $faker->numberBetween($min = 1, $max = 10),
        'vocational_currently_enrolled' => $faker->numberBetween($min = 1, $max = 10),
        'college_grad' => $faker->numberBetween($min = 1, $max = 10),
        'college_ugrad' => $faker->numberBetween($min = 1, $max = 10),
        'college_currently_enrolled' => $faker->numberBetween($min = 1, $max = 10),
        'postgrad_grad' => $faker->numberBetween($min = 1, $max = 10),
        'postgrad_ugrad' => $faker->numberBetween($min = 1, $max = 10),
        'postgrad_currently_enrolled' => $faker->numberBetween($min = 1, $max = 10),
        'zero_eleven_1degree' => $faker->numberBetween($min = 1, $max = 10),
        'zero_eleven_2degree' => $faker->numberBetween($min = 1, $max = 10),
        'zero_eleven_3degree' => $faker->numberBetween($min = 1, $max = 10),
        'one_four_1degree' => $faker->numberBetween($min = 1, $max = 10),
        'one_four_2degree' => $faker->numberBetween($min = 1, $max = 10),
        'one_four_3degree' => $faker->numberBetween($min = 1, $max = 10),
        'five_seven_1degree' => $faker->numberBetween($min = 1, $max = 10),
        'five_seven_2degree' => $faker->numberBetween($min = 1, $max = 10),
        'five_seven_3degree' => $faker->numberBetween($min = 1, $max = 10),
    ];
});
