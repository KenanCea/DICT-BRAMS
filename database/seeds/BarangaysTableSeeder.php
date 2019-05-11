<?php
use App\Barangay;
use Illuminate\Database\Seeder;

class BarangaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return factory(Barangay::class,1)->create();
    }
}
