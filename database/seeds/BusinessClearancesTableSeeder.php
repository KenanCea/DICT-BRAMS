<?php
use App\BusinessClearance;
use Illuminate\Database\Seeder;

class BusinessClearancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return factory(BusinessClearance::class,1)->create();
    }
}
