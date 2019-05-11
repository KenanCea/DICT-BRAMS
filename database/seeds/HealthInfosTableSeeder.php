<?php
use App\HealthInfo;
use Illuminate\Database\Seeder;

class HealthInfosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return factory(HealthInfo::class,1)->create();
    }
}
