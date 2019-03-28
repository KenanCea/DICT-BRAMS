<?php

use App\Filecase;
use Illuminate\Database\Seeder;

class FilecaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Filecase::class, 50)->create();
    }
}
