<?php

use App\BarangayClearance;
use Faker\Generator as Faker;

$factory->define(BarangayClearance::class, function (Faker $faker) {
    return [
        'inhabitant_id'=>App\Inhabitant::all()->random()->id,
        'control_no' => $faker->numberBetween($min = 1, $max = 20000),
        'purpose_of_clearance' => $faker->sentence(),
        'date_issued'  => $faker->date,
        'official_receipt_no' => $faker->numberBetween($min = 1, $max = 20000),
        'ctc_no' => $faker->numberBetween($min = 1, $max = 11),
        'ctc_issued_on' => $faker->date,
        'ctc_issued_at' => $faker->sentence(),
    ];
});
