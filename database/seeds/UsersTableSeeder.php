<?php

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
        DB::table('users')->insert([
            'firstname' => 'Admin',
            'lastname' => 'Admin',
            'isadmin'=> true,
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
        ]);
    }
}
