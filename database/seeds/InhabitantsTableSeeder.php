<?php

use App\Inhabitant;
use Illuminate\Database\Seeder;

class InhabitantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ini_set('memory_limit', '512M');
        DB::disableQueryLog();
         return factory(Inhabitant::class,5000)->create();
    }
}
