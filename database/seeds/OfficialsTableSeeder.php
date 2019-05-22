<?php
use App\Official;
use Illuminate\Database\Seeder;

class OfficialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return factory(Official::class,24)->create();
    }
}
