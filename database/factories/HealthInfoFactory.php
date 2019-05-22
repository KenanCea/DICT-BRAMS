<?php

use App\HealthInfo;
use Faker\Generator as Faker;

$factory->define(HealthInfo::class, function (Faker $faker) {
    return [
        'household_id' => $faker->numberBetween(1, App\Household::count()),
        'born_alived_reg' => $faker->randomDigit(),
        'born_dead_reg' => $faker->randomDigit(),
        'still_birth_reg' => $faker->randomDigit(),
        'born_alived_ureg' => $faker->randomDigit(),
        'born_dead_ureg' => $faker->randomDigit(),
        'still_birth_ureg' => $faker->randomDigit(),
        'date_still_birth' => $faker->date(),
        'dead_children_afterbirth' => $faker->randomDigit(),
        'dead-adults' => $faker->randomDigit(),
        'cause_s' => $faker->sentence(),
        'date_dead' => $faker->date(),
        'uri' => $faker->randomElement(['y', 'n']),
        'diarrhea' => $faker->randomElement(['y', 'n']),
        'weakness' => $faker->randomElement(['y', 'n']),
        'underweight' => $faker->randomElement(['y', 'n']),
        'passing_of_worms' => $faker->randomElement(['y', 'n']),
        'others_common_illness' => $faker->sentence(),
        'government_hospital' => $faker->randomElement(['y', 'n']),
        'private_hospital' => $faker->randomElement(['y', 'n']),
        'health_center' => $faker->randomElement(['y', 'n']),
        'private_doctor' => $faker->randomElement(['y', 'n']),
        'hilot' => $faker->randomElement(['y', 'n']),
        'others_health_services' => $faker->sentence(),
        'acceptor' => $faker->randomElement(['y', 'n']),
        'family_planning_yes' => $faker->randomElement(['Condom', 'Diaphragm', 'Body temperature', 'Injectibles', 'IUD', 'Ligation', 'Pills', 'Rhythm', 'Mucus', 'Natural', 'Vasectomy', 'Withdrawal']),
        'go_ngo' => $faker->sentence(),
    ];
});