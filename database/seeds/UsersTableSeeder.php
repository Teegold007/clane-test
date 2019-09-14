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

        $user =App\User::create(['id'=> '1','name' => 'clane', 'email' => 'clane@test.com',
            'password' => password_hash('123456', PASSWORD_BCRYPT)]);

        factory(App\User::class, 10)->create();
    }
}

