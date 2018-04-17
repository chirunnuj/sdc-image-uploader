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
    	DB::table('users')->insert([
    		'name'		=>	'George',
    		'email'		=>	'chirunnuj@gmail.com',
    		'password'	=>	bcrypt('9408673'),
    	]);

        // $this->call(UsersTableSeeder::class);
    }
}
