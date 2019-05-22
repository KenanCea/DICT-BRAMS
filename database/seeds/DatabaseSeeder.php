<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        ini_set('memory_limit', '512M');
        DB::disableQueryLog();
        $this->call(UsersTableSeeder::class);
        $this->call(BarangaysTableSeeder::class);
        $this->call(HouseholdsTableSeeder::class);
        $this->call(InhabitantsTableSeeder::class);
        $this->call(OfficialsTableSeeder::class);
        // $this->call(FiledcasesTableSeeder::class);
        // $this->call(EducationsTableSeeder::class);
        // $this->call(LandusesTableSeeder::class);
        // $this->call(HealthFacilitiesTableSeeder::class);
        // $this->call(InfrastructuresTableSeeder::class);
        // $this->call(CommunicationsTableSeeder::class);
        // $this->call(EducationalInfosTableSeeder::class);
        // $this->call(HealthInfosTableSeeder::class);
        // $this->call(EnvironmentInfosTableSeeder::class);
        // $this->call(BusinessClearancesTableSeeder::class);
        // $this->call(BarangayClearancesTableSeeder::class);
        // $this->call(BarangayCertificatesTableSeeder::class);
    }
}
