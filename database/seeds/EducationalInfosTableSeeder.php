<?php
use App\EducationalInfo;
use Illuminate\Database\Seeder;

class EducationalInfosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return factory(EducationalInfo::class,1)->create();
    }
}
