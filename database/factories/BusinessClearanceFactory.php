<?php

use App\BusinessClearance;
use Faker\Generator as Faker;

$factory->define(BusinessClearance::class, function (Faker $faker) {
    return [
        'inhabitant_id'=>App\Inhabitant::all()->random()->id,
        'control_no' => $faker->numberBetween($min = 1, $max = 20000),
        'business_address' => $faker->address,
        'business_trade_name' => $faker->sentence(),
        'business_application' => $faker->randomElement(['new', 'renewal']),
        'kind_business' => $faker->randomElement(['Agriculture','Construction','Electricity/gas and water','wholesale retail, and trade','Transport, storage communications', 'Community Social and personal services', 'Financing Insurance','Real States', 'Manufacturing', 'Mining']),
        'line_of_business' => $faker->randomElement(['Poultry/Livestock','Nurseries/Flower Growing','Breeding Stations','Fishponds/Fishpens','Vineyards/Mussel Farms','Orchards/Vineyards','Vegetable Farms','Supermarkets','Groceries/Dry Goods Stores','Sari-sari Stores','Banks and Financial/Lending Institutions','Auto Supply and Motorports','Distributors, Dealers of Various Products',
        'Gasoline stations','Photo and Record Shops','Jewelry Stores','Pawnshops','General Services/Contractors','Beauty Parlors or Barber shops','Fitness Gyms','Restaurants','Insurance/Dealer in Securities','Furniture Shops','Livestock and Poultry Supplyes Stores','Hardware/Electric Supplies','Videoke Shops','Computer Shops/Internet Cafe','Buy and Sell Stations','Water Refilling Stations',
        'Hotel/Inns','Apartment/Boarding House','Handicraft','Metalcraft','Garments','Ceramics','Food Processing','Mining and Quarrying','Factories','Rice/Corn/Flour/Saw Mills','Junkshops']),
        'action_taken' => $faker->randomElement(['approval', 'disapproval']),
        'reasons_approv_disapprove' => $faker->sentence(),
        'date_issued' => $faker->date,
        'ctc_no' => $faker->numberBetween($min = 1, $max = 11),
        'ctc_issued_on' => $faker->date,
        'ctc_issued_at' => $faker->sentence(),
        'official_receipt_no' => $faker->numberBetween($min = 1, $max = 11),
        'date_OfficialReceipt'=> $faker->date,
        'total_amt_paid'=> $faker->numberBetween($min = 1, $max = 4),
    ];
});
