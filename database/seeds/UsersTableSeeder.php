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
        //
        $user = [
            'name' => 'ahmed emad',
            'email'=>'ahmed.emad2051@gmail.com',
            'password'=>bcrypt(123456)
        ];
        User::create($user);
    }
}
