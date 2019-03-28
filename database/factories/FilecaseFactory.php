<?php
use App\Filecase;
use Faker\Generator as Faker;

$factory->define(App\Filecase::class, function (Faker $faker) {
    return [
        'id_serial_case_num' =>$faker->randomDigit,
        'control_no_case' =>$faker->randomDigit,
        'respondent_case' =>$faker->firstName,
        'nature_of_case' =>$faker->randomElement(['Criminal','Civil','Others']),
        'complainant_case' =>$faker->firstName,
        'date_filed_case' =>$faker->date($format = 'Y-m-d', $max = 'now'),
        'action_taken_on_settled_case' =>$faker->randomElement(['Mediation','Arbitration','Conciliation']),
        'action_taken_on_unsettled_case' =>$faker->randomElement(['Repudiation','Withdrawn','Pending Case','Case Dismissed','Case Certified','Referred to concerned Agencies']), 
        'remarks_case' =>$faker->sentence,
        //'form_id',
        //'mem_id',
    ];
});
