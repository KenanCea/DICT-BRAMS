<?php
use App\Communication;
use Illuminate\Database\Seeder;

class CommunicationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return factory(Communication::class,1)->create();
    }
}
