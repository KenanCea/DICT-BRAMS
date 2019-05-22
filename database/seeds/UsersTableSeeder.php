<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // return factory(User::class,1)->create();
        if (DB::table('users')->get()->count() == 0) {
            DB::table('users')->insert([
                // [
                //     'name' => ('admin'),
                //     'email' => ('admin@gmail.com'),
                //     'password' => bcrypt('password'),
                //     'roles' => ('admin'),
                //     'logo' => ('profile.png'),
                //     'remember_token' => str_random(10),
                //     'email_verified_at' => now(),
                //     'created_at' => now(),
                //     'updated_at' => now()
                // ], 
                [
                    'name' => ('Camp Allen'),
                    'email' => ('campallen@gmail.com'),
                    'password' => bcrypt('password'),
                    'roles' => ('user'),
                    'logo' => ('profile.png'),
                    'remember_token' => str_random(10),
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => ('Kayang Extension'),
                    'email' => ('kayangext@gmail.com'),
                    'password' => bcrypt('password'),
                    'roles' => ('user'),
                    'logo' => ('profile.png'),
                    'remember_token' => str_random(10),
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now()
                ],
            ]);
        } else {
            echo "\e[31mTable is not empty, therefore NOT ";
        }
    }
}
