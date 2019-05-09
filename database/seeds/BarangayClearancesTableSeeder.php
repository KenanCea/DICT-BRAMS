<?php
use App\BarangayClearance;
use Illuminate\Database\Seeder;

class BarangayClearancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return factory(BarangayClearance::class,1)->create();
    }
}
