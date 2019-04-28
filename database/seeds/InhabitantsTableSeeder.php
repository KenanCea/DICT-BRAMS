<?php

use App\Inhabitant;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class InhabitantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // return factory(Inhabitant::class, 30000)->create();
        $faker = Faker::create();
        foreach (range(1, 10000) as $index) {
            DB::table('inhabitants')->insert([
                'household_id'=>App\Household::all()->random()->id,
                'user_id'=>App\User::all()->random()->id,
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'middle_name' => $faker->lastName,
                'relation_to_the_head' => $faker->randomElement(['The Head','Aunt','Uncle','Brother-in-law','Brother','Daughter-in-law','Daughter','Son','Son-in-law','Sister','Sister-in-law','Father','Mother','Grandfather','Grandmother','Husband','Wife','Tenant','Househelper','Common law wife']),
                'sex' => $faker->randomElement(['female', 'male']),
                'date_of_birth' => $faker->date,
                'placeOfBirth_native' =>$faker->address,
                'civil_status' => $faker->randomElement(['Single', 'Married', 'Widow/er', 'Separated', 'Common-law', 'Complicated']),
                'religion' => $faker->randomElement(['Aglipayan','Anglican','Apostolic Christian','Assembly of God','Baptist','Church of Christ','Born Again Christian','Iglesia ni Cristo','Islam','Saksi ni Jehovah','Seventh Day Adventist','Methodist','Mormons','Pentecost','Protestant','Roman Catholic']),
                'schooling' => $faker->randomElement(['n/a','In School','Out of School','Not yet in school','Graduate']),
                'Highest_educational_attainment' => $faker->randomElement(['Elem. Graduate','Elementary','High school undergraduate','High school','College undergraduate','College graduate','Vocational','Post Graduate','Pre-school','Not yet attending school']),
                'Final_family_income' => $faker->numberBetween($min = 100000, $max = 1000000),
                'Total_family_income' => $faker->numberBetween($min = 10000, $max = 100000000),
                'status_of_residency' => $faker->randomElement(['Permanent', 'Live-in relative', 'Boarder', 'Buss resident', 'Moved out', 'Deceased']),
                'no_of_years_in_barangay' => $faker->randomDigit(),
                'date_settled_in_barangay' => $faker->date,
                'citizenship' => $faker->randomElement(['Filipino']),
                'ethnicGroup' => $faker->randomElement(['Bago','Bicol','Bisaya','Boholano','Bontoc','Capizeno','Cuyunon','Ibaloi','Ilonggo','Ifugao','Ilocano','Ivatan','Kalinga','Kankana-ey','Kapangpangan','Maguindanao','Maranao','Masbateno','Pangasinan','Surigaoan','Tagalog','Tausog','Waray','Yakan','Zamboagueno/Chavacano']),
                'registeredVoterOfTheBrgy' => $faker->randomElement(['yes', 'no']),
                'pregnant' => $faker->randomElement(['n/a','y']),
                'expected_date' => $faker->date,
                'blood_type' => $faker->randomElement(['A','B','AB','O','Do not know']),
                'disability' => $faker->randomElement(['None','Total blindness of one eye','Total blindness of both eye','Missing one or both arms','Mongoloid','Cleff Palate','Malabo ang paningin/poor eyesight','Hunchback','Paralyzed legs','Paralyzed arms','Speech disorder','Authistic','Fractured Vertebrate column','Paralyzed from neck down','Hydrocephalus',
                'Deaf','Mute and Deaf','Inability to walk alone','Deformity','Polio','Mental Impairment','Celebral Palsy','Epileptic','Dwarfism','Others']),
                'dissability_others' => $faker->sentence(),
                'remarks' => $faker->sentence(),
                'specific_job_description' => $faker->sentence(),
                'gen_job_description' => $faker->randomElement(['n/a', 'Accountant', 'Architect', 'Barangay Official', 'Businessman', 'Doctor','Engineer','Fireman','Government office worker','IT Worker','Lawyer','Librarian','Manager/Supervisor','Missionary','Nurse',
                'OFW','Pharmacist','Policemen','Priest','Professor/Instructor','Preacher/Pastor','Researcher','Soldier','Seafarer','Teacher','Therapist','Call center agent','Caregiver','Carpenter','Caretaker','Cashier/clerk','Construction worker','Cosmetologist/Beautician',
                'Dispatcher/Barker','Driver','Electrician','Factory Worker','Farmer/Gardener','Helper/Aide','Laborer','Laundrywoman','Machinist','Mechanic','Mason','Mine Worker','Porter','Plumber','Salesperson','Security Guard','Secretary','Service Crew','Student Assistance','Tailor/Sewer/Dressmaker',
                'Technician','Vendor','Volunteer Woker','Welder']),
                'employment_status' => $faker->randomElement(['Permanent', 'Contractual', 'Temporary', 'Self-employed', 'Retired', 'Unknown']),
                'job_category' => $faker->randomElement(['Offical Government and Special Interest', 'Professional', 'Technicians and Assoc. Professional', 'Clerks','Service Workers & Market sales workers','Farmers & Forestry Workers','Trades & related workers','Machine Operators/Assemblers','Laborers & skilled workers','Special Occupations','n/a']),
                'employment_category' => $faker->randomElement(['Private','Government','Self employed','Overseas']),
                'estimated_monthly_income_cash' => $faker->numberBetween($min=1, $max=10000),
                'estimated_monthly_income_kind' => $faker->sentence(),
                'childs_parent_guardian' => $faker->name,
                'bcg' => $faker->randomelement(['y','n']),
                'dpi1' => $faker->randomelement(['y','n']),
                'dpi2' => $faker->randomelement(['y','n']),
                'dpi3' => $faker->randomelement(['y','n']),
                'opd1' => $faker->randomelement(['y','n']),
                'opd2' => $faker->randomelement(['y','n']),
                'opd3' => $faker->randomelement(['y','n']),
                'measles' => $faker->randomelement(['y','n']),
                'others1' => $faker->randomelement(['y','n']),
                'others2' => $faker->randomelement(['y','n']),
                'others3' => $faker->randomelement(['y','n']),
                'weight' => $faker->numberBetween($min=1, $max=3),
                'height' => $faker->numberBetween($min=1, $max=3),
                'date_measured_height_weight' => $faker->date,
                'dewormed' => $faker->randomelement(['yes','no']),
                'received_vitaminA' => $faker->randomelement(['yes','no']),
                'ip' => $faker->sentence()
            ]);
        }
    }
}
