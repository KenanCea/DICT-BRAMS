<?php
use App\HealthFacilities;
use Illuminate\Database\Seeder;

class HealthFacilitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return factory(HealthFacilities::class,1)->create();
    }
}
