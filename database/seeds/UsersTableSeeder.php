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
            'username' => 'Admin',
            'name' => 'Germán Reyes Donoso',
            'email' => 'ger.reyesd@gmail.com',
            'password' => bcrypt('1234'),
            'admin' => true
        ]);
    }
}
