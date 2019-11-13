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
        \App\User::create(
            [
                'name'=>'Jamal Apriadi',
                'email'=>'jamal.apriadi@gmail.com',
                'email_verified_at'=>date('Y-m-d H:i:s'),
                'password'=>bcrypt('welcome'),
                'active'=>'Y'
            ]
        );
    }
}
