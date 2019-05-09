<?php

use App\Barangay;
use Faker\Generator as Faker;

$factory->define(Barangay::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, App\User::count()),
        'name' => $faker->unique()->randomElement(['Gibraltar','Mines View','Pacdal','Pucsusan','St. Joseph Village','Country Club Village','Happy Hollow','Lualhati','Lucnab','Outlook Drive','South Drive',
        'Cabinet Hill','DPS Compound','Engineers Hill','Marcoville','Greenwater Village','Fort Del Pilar','Kias','Loakan Apugan','Loakan Liwanag','Loakan Proper',
        'Gabriela Silang','Hillside','Lower Dagsian','Santa Escolastica Village','Upper Dagsian','Scout Barrio','Camp 7','Camp 8','Military Cut-off','Poliwes','San Vicente',
        'Baguio General Hospital Compound','Balsigan','Burnham Legarda Kisad','Imelda Marcos (La Salle)','Phil-Am','Santo Rosario','Ferdinand (Happy Homes-Campo Sioco)','Bakakeng Central','Bakakeng Norte','Dontogan','SLU / SVP Housing Village','Santo Tomas Proper','Sto. Tomas School Area',
        'City Camp Central','City camp Proper','General Emilio Aguinaldo (Lower Quirino Magsaysay)','Lower Rock Quarry','Middle Rock Quarry','Palma Urbano (Cariño-Palma)','Upper Quirino Magsaysay (Upper QM)','Upper Rock Quarry','Asin','Dominican Mirador','Lourdes Subdivision Ext.','Lourdes Subdivision Proper','Lower Lourdes Subdivision','San Luis Village','San Roque Village',
        'Andres Bonifacio (Lower Bokawkan)','Camp Allen','Campo Filipino','Fairview','Kayang Extension','MRR Queen of Peace','Upper Market Subdivision','Irisan','Middle Quezon Hill Subd','Pinsao Proper','Quezon Hill Proper','Upper Quezon Hill','Victoria Village','Central Guisad','Crescencia Village','Guisad Surong','Lower Magsaysay','Padre Burgos','Padre Zamora','Pinsao Pilot Project','Slaughter (Sto. Niño)',
        'Alfonso Tabora','Magsaysay Private Road','New Lucban','North Sanitary Camp','South Sanitary Camp','Trancoville','Camdas Subdivision','Dizon Subdivision','East Quirino Hill','Happy Homes Old Lucban','Lower Quirino Hill','Middle Quirino Hill','Pinget','West Quirino Hill',
        'Andres Bonifacio - Caguioa Rimando (ABCR)','Abanao-Zandueta-Chugum-Kayang Otek (AZKCO)','Bagong Lipunan (Market Area)','Kagitingan','Kayang Hilltop','Rizal Monument Area','Teodora Alonzo','Upper Magsaysay','Kabayanihan','Ambiong','Bayan Park Village','Bayan Park East','North Central Aurora Hill','San Antonio Village','South Central Aurora Hill','Bayan Park West (Bayan Park)','Aurora Hill Proper (Malvar-Sgt. Floresca)','Brookside',
        'Brookspoint','East Modern Site','Lopez Jaena','West Modern Site','Harrison-Claudio Carantes','Lower General Luna','Malcolm Square - Perfecto (Jose Abad Santos)','Salud Mitra','Session Road Area','Upper General Luna Road','Holyghost Extension','Holyghost Proper','Honeymoon (Honeymoon-Holyghost)','Manuel Roxas','Imelda Village']),
        'province' =>$faker->randomElement(['Benguet']),
        'muni_city'=>$faker->randomElement(['Baguio']),
        'region' =>$faker->randomElement(['CAR']),
        'legal_basis' =>$faker->sentence(10),
        'date_legal_basis' =>$faker->date,
        'date_ratification' =>$faker->date,
        'type_barangay' => $faker->randomElement(['Rural', 'Urban', 'Tribal']),
        'boundaries_north' => $faker-> numberBetween($min = 1000, $max = 20000),
        'boundaries_east' => $faker-> numberBetween($min = 1000, $max = 20000),
        'boundaries_west' => $faker-> numberBetween($min = 1000, $max = 20000),
        'boundaries_south' => $faker-> numberBetween($min = 1000, $max = 20000),
        'totalland_area_sqkm' => $faker-> numberBetween($min = 1000, $max = 20000),
        'totalland_area_hec' => $faker-> numberBetween($min = 1000, $max = 20000),
        'distance_municipal_city' => $faker-> numberBetween($min = 1000, $max = 20000),
        'province_capitol' => $faker-> numberBetween($min = 1000, $max = 20000),
        'national_highway' => $faker-> numberBetween($min = 1000, $max = 20000),
        'mountainous' => $faker->randomElement(['0-25%','26-50%','51-75%','76-100%']),
        'plain' => $faker->randomElement(['0-25%','26-50%','51-75%','76-100%']),
        'valley' => $faker->randomElement(['0-25%','26-50%','51-75%','76-100%'])
    ];
});
