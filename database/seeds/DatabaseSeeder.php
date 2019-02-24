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
                    'username' => ('admin'),
                    'email' => ('admin@gmail.com'),
                    'password' => bcrypt('secret'),
                    'type' => ('admin'),
                    'photo' => ('profile.png'),
                    'remember_token' => str_random(10),
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ], [
                    'username' => ('baguio_ambiong'),
                    'email' => ('user@gmail.com'),
                    'password' => bcrypt('secret'),
                    'type' => ('user'),
                    'photo' => ('profile.png'),
                    'remember_token' => str_random(10),
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ], [
                    'username' => ('baguio_irisan'),
                    'email' => ('user1@gmail.com'),
                    'password' => bcrypt('secret'),
                    'type' => ('user'),
                    'photo' => ('profile.png'),
                    'remember_token' => str_random(10),
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        } else {echo "\e[31mTable is not empty, therefore NOT ";}

    }
}
