<?php
use App\BarangayCertificate;
use Illuminate\Database\Seeder;

class BarangayCertificatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return factory(BarangayCertificate::class,1)->create();
    }
}
