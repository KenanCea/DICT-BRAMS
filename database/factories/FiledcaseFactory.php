<?php

use App\Filedcase;
use Faker\Generator as Faker;

$factory->define(Filedcase::class, function (Faker $faker) {
    return [
        'inhabitant_id'=>App\Inhabitant::all()->random()->id,
        'control_no' => $faker->numberBetween($min=1, $max=20000),
        'respondent' => $faker->name,
        'case' => $faker-> randomElement(['Collecting sum of money','Estafa','Malicius Mischief','Physical Injury','Physical Injury with Robbery','Theft','Threat','Unjust Vexation','Murder','Rape','Children in Conflict of the law']),
        'type_of_case' => $faker->sentence(),
        'complainant' => $faker->name,
        'co_complainant' => $faker->name,
        'date_filed' => $faker->date,
        'action_taken_on_settled' => $faker-> randomElement(['Arbitration', 'Conciliation', 'Mediation']),
        'action_taken_on_unsettled' => $faker-> randomElement(['Repudiation', 'Withdrawn', 'Pending case', 'Case dismissed', 'Case certified', 'Referred to concerned agencies']),
        'remarks' => $faker-> sentence(),
    ];
});
