<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Validator,
    Input,
    Redirect,
    Hash,
    Mail;

class PagesController extends Controller {

    public function home() {
        //$mydata= DB::table('users')->where('id',$id);

        $users = DB::table('users')->paginate(2);
        return view('home', ['users' => $users]);
    }

    public function editUser($id) {
        $users = DB::table('users')->where('id', $id)->get();
        return view('editUser', ['users' => $users]);
    }

    public function deleteUser($id) {

        $users = DB::table('users')->where('id', $id)->get();
        return view('deleteUser', ['users' => $users]);
    }

    public function login() {
        return view('auth.login');
    }

     public function password() {
        return view('/auth/password');
    }
    public function signup() {
        return view('auth.register');
    }

    public function tes() {

        

        $sent = Mail::send('emails.tes', array('key' => 'value'), function($message) {
                    $message->from('beni.santoso@1rstwap.com');
                    $message->to('beni.santoso@1rstwap.com', 'John Smith')->subject('Welcome!');
                });

        if (!$sent)
            dd("something wrong");
        dd("send");
    }

}
