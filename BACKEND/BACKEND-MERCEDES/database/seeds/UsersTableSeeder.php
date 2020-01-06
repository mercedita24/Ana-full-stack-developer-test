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
        App\User::create([

       'id' => '1',
       'password'=> bcrypt('12345678'),
       'email'=>'mercedes@hello.com',
       'name'=>'Mercedes Garcia',
     ]);
    }
}
