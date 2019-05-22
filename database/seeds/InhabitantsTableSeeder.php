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
        return factory(Inhabitant::class, 20000)->create();
    }
}
