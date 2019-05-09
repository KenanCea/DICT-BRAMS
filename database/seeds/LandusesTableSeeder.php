<?php
use App\Landuse;
use Illuminate\Database\Seeder;

class LandusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return factory(Landuse::class,1)->create();
    }
}
