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
           'email'=> 'admin@gmail.com',
           'password'=> bcrypt('ADMIN12345'),
           'role'=> 'admin'
       ]);
    }
}
