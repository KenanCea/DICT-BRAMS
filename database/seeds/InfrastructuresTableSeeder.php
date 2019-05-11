<?php
use App\Infrastructure;
use Illuminate\Database\Seeder;

class InfrastructuresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return factory(Infrastructure::class,1)->create();
    }
}