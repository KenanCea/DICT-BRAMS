<?php

use App\Inhabitant;
use Faker\Generator as Faker;

$factory->define(App\Inhabitant::class, function (Faker $faker) {
    return [
        'household_id'=> $faker->randomDigit,
        'first_name'=> $faker->firstName,
        'middle_name'=> $faker->lastName,
        'last_name'=> $faker->lastName,
        'relation_to_the_head'=> $faker->randomElement(['THE HEAD', 'Aunt', 'Brother-in-law', 'Brother', 'Daugther-in-law', 'Daughter', 'Father', 'Grandfather', 'Grandmother', 'Househelper', 'Husband', 'Mother', 'Son', 'Son-in -law', 'Sister-in-law', 'Tenant', 'Uncle', 'Wife', 'Common law wife']),
        'employment_category'=> $faker->randomElement(['Private', 'Government', 'Self employed', 'Overseas']),
        'sex'=> $faker->randomElement(['male','female']),
        'est_monthly_income_cash'=> $faker->randomDigit,
        'date_of_birth'=> $faker->date($format = 'Y-m-d', $max = 'now'),
        'est_monthly_income_kind'=> $faker->randomElement(['Rice', 'Vegetables', 'Free rental', 'City services']),
        'total_family_income'=> $faker->randomDigit,
        'civil_status'=> $faker->randomElement(['Single', 'Married', 'Widow/er', 'Separated', 'Common-Law', 'Complicated']),
        'final_family_income'=> $faker->randomDigit,
        'religion'=> $faker->randomElement(['Aglipayan', 'Anglican', 'Apostolic Christian', 'Assembly of God', 'Baptist', 'Church of Christ', 'Born Again Christian', 'Iglesia ni Cristo', 'Islam', 'Saksi ni Jehovah', 'Seventh Day Adventist', 'Methodist', 'Mormons', 'Pentecost', 'Protestant', 'Roman Catholic']),
        'status_of_residency'=> $faker->randomElement(['Permanent', 'Live-in relative', 'Boarder', 'Buss Resident', 'Moved Out', 'Deceased']),
        'schooling'=> $faker->randomElement(['In school', 'Out of school', 'Not yet in school', 'Graduate']),
        'no_of_years_in_barangay'=> $faker->randomDigit,
        'highest_educ_attainment'=> $faker->randomElement(['Elem. undergraduate', 'Elementary', 'High sch undergraduate', 'High school', 'College undergraduate', 'College Graduate', 'Vocational', 'Post Graduate', 'Pre-school', 'Not yet attending school']),
        'date_settled_in_the_barangay'=> $faker->date($format = 'Y-m-d', $max = 'now'),
        'specific_job_description'=> $faker->sentence,
        'citizenship'=> $faker->randomElement(['Filipino']),
        'gen_job_description'=> $faker->randomElement(['Security Guard', 'Secretary', 'Service Crew', 'Student Assistant', 'Tailor/Sewer/Dressmaker', 'Technician', 'Vendor', 'Volunteer Woker', 'Welder', 'none', 'n/a']),
        'employment_status'=> $faker->randomElement(['Permanent', 'Contractual', 'Temporary', 'Self-employed', 'Retired']),
        'ethnic_group'=> $faker->randomElement(['Bago', 'Bicol', 'Bisaya', 'Boholano', 'Bontoc', 'Capizeno', 'Cuyunon', 'Ibaloi', 'Ilonggo', 'Ifugao', 'Ilocano', 'Ivatan', 'Kalinga', 'Kapangpangan', 'Maguindanao', 'Maranao', 'Masbateno', 'Pangasinan', 'Surigaoan', 'Tagalog', 'Tausog', 'Waray', 'Yakan', 'Zamboagueno/Chavacano']),
        'job_category'=> $faker->randomElement(['Offical Government and Special Interest', 'Professional', 'Technicians and Assoc. Professional', 'Clerks', 'Service Workers & Market sales workers', 'Farmers & Forestry Workers', 'Trades & related workers', 'Machine Operators/Assemblers', 'Laborers & skilled workers', 'Special Occupations', 'n/a']),
        'place_of_birth'=> $faker->sentence,
        'registered_voter'=> $faker->randomElement(['Yes', 'No']),
        'child_parent'=> $faker->name,
        'weight'=> $faker->randomDigit,
        'height'=> $faker->randomDigit,
        //'household_id' => App\Household::all()->random()->id,
    ];
});
