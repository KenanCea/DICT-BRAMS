<?php
use App\Filedcase;
use Illuminate\Database\Seeder;

class FiledcasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return factory(Filedcase::class,1)->create();
    }
}
