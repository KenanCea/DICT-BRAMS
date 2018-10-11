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
    //    $this->call(UsersTableSeeder::class);
    $members = factory(App\Member::class, 1000)->create();
        if (DB::table('users')->get()->count() == 0) {
            DB::table('users')->insert([
                [
                    'name' => ('admin'),
                    'email' => ('admin@gmail.com'),
                    'password' => bcrypt('secret'),
                    'type' => ('admin'),
                    'photo' => ('profile.png'),
                    'remember_token' => str_random(10),
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now()
                ], [
                    'name' => ('baguio_ambiong'),
                    'email' => ('baguio_ambiong@gmail.com'),
                    'password' => bcrypt('secret'),
                    'type' => ('user'),
                    'photo' => ('profile.png'),
                    'remember_token' => str_random(10),
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now()
                ], [
                    'name' => ('baguio_aurora'),
                    'email' => ('baguio_aurora@gmail.com'),
                    'password' => bcrypt('secret'),
                    'type' => ('user'),
                    'photo' => ('profile.png'),
                    'remember_token' => str_random(10),
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now()
                ],
            ]);
        } else {echo "\e[31mTable is not empty, therefore NOT ";}

    }
}
