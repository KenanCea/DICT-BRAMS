<?php

use App\Household;
use Faker\Generator as Faker;

$factory->define(Household::class, function (Faker $faker) {
    return [
        'user_id'=>App\User::all()->random()->id,
		'familyName' => $faker->lastName,
        'firstName' => $faker->firstName,
        'middleName' => $faker->lastName,
        'solo_parent' => $faker->randomElement(['no','Death of spouse', 'Imprisonment of spouse of at least 1 year', 'Mental/physical incapacity of spouse', 'Legal or de facto separation from spouse for at least 1 year', 'Abandonment of spouse for at least 1 year', 'Unmarried mother/father who preferred to keep the child instead of others carrying him/her', 'Any other person who solely provides parental care and support to a child provided he/she is duly licensed foster parent of DSWD', 'Any family member who assumes the responsibility as head of the family as a result of death, abandonment, absence for at least one year','others']),
        'solo_parent_others' =>$faker->sentence(),
        'dateOfSurvey' => $faker->date(),
        'familysize' => $faker->randomDigit(),
        'house_no' => $faker->randomDigit(),
        'purok' => $faker->randomDigit(),
        'street' =>$faker->sentence(10),
        'barangay' =>$faker->sentence(10),
        'placeOfOrigin' =>$faker->sentence(10),
        'ethnic_group' =>$faker->randomElement(['Bicol','Bisaya','Boholano','Capizeno','Cuyunon','Ibaloi','Ilonggo','Ifugao','Ilocano','Ivatan','Kalinga','Kankana-ey','Kapangpangan','Maguindanao','Maranao','Masbateno','Pangasinan','Surigaoan','Tagalog','Tausog','Waray','Yakan','Zambagueno/Chavacano','N/A']),
        'email_address' => $faker->email,
        'mobile_no' => $faker->randomDigit(),
        'telephone_no' => $faker->randomDigit(),
        'dialects' =>$faker->randomElement(['Bicolano','Bontoc','Cebuano','English','Ibaloi','Ibanag','Ifugao','Ilocano','Itneg','Kalinga','Kankana-ey','Pampangan','Pangasinan','Tagalog','Waray-waray','Panggalatok','Visaya','Kapangpangan']),
        'status_of_ownership-house' => $faker->randomElement(['Owned','Rented','Caretaker','Others']),
        'status_of_ownership-house_others' =>$faker->sentence(10),
        'status_of_ownership-lot' =>$faker->randomElement(['Owned','Rented','Caretaker','Others']),
        'status_of_ownership-lot_others' =>$faker->sentence(10),
        'type_of_dwelling' =>$faker->randomElement(['Permanent Concrete','Semi Permanent','Temporary']),
        'lighting source' =>$faker->randomElement(['Electricity', 'Solar', 'Petromax', 'Kerosene']),
        'sources_of_info' =>$faker->randomElement(['Television', 'Radio', 'Newspaper','Others']),
        'sources_of_info_others' =>$faker->sentence(10),
        'communication_services' =>$faker->randomElement(['Cell sites/Net', 'Internet', 'Telephone', 'Postal services','others']),
        'communication_services_others' =>$faker->sentence(10),
        'means of transportation' =>$faker->randomElement(['PU jeep', ' Taxi', 'Tricycle', 'PU bus', 'Private car','others']),
        'means of transportation_others' =>$faker->sentence(10),
    ];
});
