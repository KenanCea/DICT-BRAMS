<?php

use Faker\Generator as Faker;

$factory->define(App\Member::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'family_name' => $faker->lastName,
        'middle_name' => $faker->lastName,
        'sex' => $faker->randomElement(['male','female']),
        'created_at' => now(),
        'updated_at' => now(),
        'region_barangay' => $faker->lastName,
        'relation_to_head' => $faker->randomElement(['sister', 'brother', 'head', 'aunt', 'uncle', 'mother']),
        'placeOfBirth' => $faker->address,
        'dateOfBirth' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'email_add' => $faker->email,
        'mobile_no' => $faker->randomDigit,
        'telephone_no' => $faker->randomDigit,
        'civilStatus' => $faker->randomElement(['single', 'married', 'widow', 'separated', 'common-law', 'complicated']),
        'citizenship' => ('filipino'),
        'religion' => ('roman catholic'),
        'schooling' => $faker->lastName,
        'Highest_educational_attainment' => $faker->randomElement(['college', 'high school', 'elementary']),
        'familyIncome' => $faker->randomDigit,
        'statusOfResidency' => $faker->randomElement(['permanent', 'live-in relative', 'boarder', 'buss resident', 'moved out', 'deceased']),
        'ethnicGroup' => $faker->randomElement(['ibaloi', 'kankana-ey', 'filipino']),
        'height' => $faker->randomDigit,
        'weight' => $faker->randomDigit,
        'bloodType' => $faker->randomElement(['A', 'B', 'O', 'AB']),
        'registeredVoterOfTheBrgy' => $faker->randomElement(['yes', 'no']),
        'mem_pic' => $faker->randomDigit,
        'previousResidence' => $faker->randomDigit,
        'no_of_months_and_year_living_in_this_brgy' => $faker->randomDigit,
        'reason_you_left_in_previous_brgy' => $faker->sentence,
        'reason_you_came_in_this_brgy' => $faker->sentence,
        'until_when_you_stay_in_this_brgy' => $faker->randomDigit,
        'who_accompanied_you_to_transfer_here' => $faker->lastName,
        'barangay_id' => $faker->numberBetween($min = 1, $max = 2),
    ];
});
