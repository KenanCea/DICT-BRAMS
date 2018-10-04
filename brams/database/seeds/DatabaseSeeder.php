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
//        $this->call(UsersTableSeeder::class);
        if (DB::table('users')->get()->count() == 0) {
            DB::table('users')->insert([
                [
                    'name' => ('admin'),
                    'email' => ('admin@gmail.com'),
                    'password' => bcrypt('secret'),
                    'type' => ('admin'),
                    'photo' => ('logo.png'),
                    'remember_token' => str_random(10),
                    'email_verified_at' => now(),
                ], [
                    'name' => ('user'),
                    'email' => ('user@gmail.com'),
                    'password' => bcrypt('secret'),
                    'type' => ('user'),
                    'photo' => ('logo.png'),
                    'remember_token' => str_random(10),
                    'email_verified_at' => now(),
                ],
            ]);
        } else {echo "\e[31mTable is not empty, therefore NOT ";}

    }
}
