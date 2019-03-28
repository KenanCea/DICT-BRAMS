<?php

use App\Household;
use Faker\Generator as Faker;

$factory->define(App\Household::class, function (Faker $faker) {
    return [
		'user_id'=> $faker->randomDigit,
		'house_number'=> $faker->randomDigit,
        'barangay'=> $faker->address,
        'email_address'=> $faker->email,
        'purok' => $faker->randomDigit,
        'place_of_origin'=> $faker->address,
        'mobile_number'=> $faker->randomDigit,
        'street'=> $faker->randomDigit,
        'ethnic_group'=> $faker->randomElement(['Bicol','Bisaya','Boholano','Capizeno','Cuyunon','Ibaloi','Ilonggo','Ifugao','Ilocano','Ivatan','Kalinga','Kankana-ey','Kapangpangan','Maguindanao','Maranao','Masbateno','Pangasinan','Surigaoan','Tagalog','Tausog','Waray','Yakan','Zambagueno/Chavacano','N/A']),
        'telephone_no'=> $faker->randomDigit,
        'status_of_ownership-house'=> $faker->randomElement(['Owned','Rented','Caretaker','Others']),
        'status_of_ownership-lot'=> $faker->randomElement(['Owned','Rented','Caretaker','Others']),
        'type_of_dwelling'=> $faker->randomElement(['Permanent Concrete','Semi Permanent','Temporary']),
    ];
});
