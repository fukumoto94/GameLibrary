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

        $user = new User();
        $user->name  = "Administrator";
        $user->email = 'lucas.fukumoto@hotmail.com';
        $user->password = bcrypt('admin');
        $user->save();


    }
}
