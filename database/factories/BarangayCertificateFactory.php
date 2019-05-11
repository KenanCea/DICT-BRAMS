<?php

use App\BarangayCertificate;
use Faker\Generator as Faker;

$factory->define(BarangayCertificate::class, function (Faker $faker) {
    return [
        'inhabitant_id'=>App\Inhabitant::all()->random()->id,
        'control_no' => $faker->numberBetween($min = 100, $max = 200000),
        'purpose_certification' => $faker->sentence(),
        'date_issued' => $faker->date,
        'ctc_no' => $faker->numberBetween($min = 100, $max = 200000),
        'ctc_issued_at' => $faker->sentence(),
        'ctc_issued_on' => $faker->date,
        'official_receipt_no' => $faker->numberBetween($min = 100, $max = 200000),
        'amount_paid' => $faker->numberBetween($min = 1, $max = 4),
    ];
});
