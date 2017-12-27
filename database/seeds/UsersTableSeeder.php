<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Adm',
            'email' => 'adm@adm.com',
            'password' => bcrypt('1234'),
            'admin' => true
        ]);
    }
}
