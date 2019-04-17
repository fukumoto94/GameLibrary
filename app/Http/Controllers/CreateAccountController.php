<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class CreateAccountController extends Controller
{
    function insert(Request $req){
        $newUser = $req->input('newUser');
        $password = $req->input('password');
        $email = $req->input('email'); 

        $data = array('name'=>$newUser, 'password'=>$password, 'email'=>$email);

        DB::table('users')->insert($data);

        return view('create');
    }
}
