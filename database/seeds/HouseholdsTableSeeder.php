<?php

use App\Household;
use Illuminate\Database\Seeder;

class HouseholdsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return factory(Household::class,1000)->create();
    }
}
