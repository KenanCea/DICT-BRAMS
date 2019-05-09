<?php
use App\EnvironmentInfo;
use Illuminate\Database\Seeder;

class EnvironmentInfosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return factory(EnvironmentInfo::class,1)->create();
    }
}
