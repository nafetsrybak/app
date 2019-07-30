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
        //
        DB::table('users')->insert([
        	'name' => 'Stefan',
        	'role_id' => 1,
        	'is_active' => 1,
        	'email' => 'nafetsrybak@gmail.com',
        	'password' => bcrypt('rockondc96'),
        	'remember_token' => str_random(10),
        	'created_at' => date('Y-m-d G:i:s'),
        	'updated_at' => date('Y-m-d G:i:s')
        ]);
    }
}
