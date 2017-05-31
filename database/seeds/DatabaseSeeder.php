	<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'firstName' => 'Super',
            'lastName' => 'Admin',
            'email' => 'admin@gmail.com',
            'mobile' => str_random(10),
            'password' => bcrypt('secret'),
            'role' => 4	
        ]);
    }
}
