<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InsertController
 *
 * @author beni
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Validator,
    Helper,
    Input,
    Redirect,
    Hash,
    Crypt,
    Mail,
    Auth;

class InsertController extends Controller {

    //put your code here

    public function signup(Request $request) {
        $data = Input::all();
        $rules = array(
            'Name' => 'required',
            'Password' => 'required',
            'RetypePassword' => 'required|same:Password',
            'Sex' => 'required',
            'Email' => 'required|email'
        );
        $data['link'] = asset('/') . 'active';
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return Redirect::to('signup')->withErrors($validator)->withInput();
        }

        $cekUser = DB::table('users')->where('email', '=', $data['Email'])->count();

        if ($cekUser > 0) {
            return Redirect::to('signup')->withErrors('User already exist please use another email or click forget password');
        }
        $data['Password'] = Crypt::encrypt($data['Password']);
        DB::table('users')->insert(
                ['name' => $data['Name'],
                    'password' => $data['Password'],
                    'sex' => $data['Sex'],
                    'active' => 0,
                    'email' => $data['Email'],
                    'created_at' => time()
                ]
        );
        DB::table('users_activated')->insert(
                ['remember_token' => $data['Password'],
                    'email' => $data['Email']
                ]
        );

        $sent = Mail::send('emails.token_user', $data, function($message) use ($data) {
                    $message->from('beni.santoso@1rstwap.com');
                    $message->to($data['Email'], $data['Name'])->subject('Welcome!');
                });
        if (!$sent) {
            return Redirect::to('signup')->withErrors('Fail to sent email');
        }
        return Redirect::to('login')->with('status', 'Succes create user please cek your email to active your account ');
    }

    public function doLogin() {
        $data = Input::all();

        $rules = array(
            'email' => 'required',
            'password' => 'required'
        );

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return Redirect::to('login')->withErrors($validator)->withInput();
        }

        $userdata = array(
            'email' => $data['email'],
            'password' => Crypt::encrypt($data['password']),
            'decrypt'=>Crypt::decrypt($data['password'])
        );
        dd($userdata);
        // attempt to do the login
        if ($this->cekUser($userdata)) {

            // validation successful!
            // redirect them to the secure section or whatever
            // return Redirect::to('secure');
            // for now we'll just echo success (even though echoing in a controller is bad)

            return Redirect::to('home');
        } else {
            var_dump($userdata);
            return Redirect::to('login')->withErrors('error : fail to login');
        }
    }

    public function activeUser($token) {

        $cekUser = DB::table('users_activated')->where('remember_token', '=', $token)->take(1)->get();

        if ($cekUser) {
            $change = DB::table('users')->where('email', '=', $cekUser[0]->email)->update(array('active' => 1));
            if ($change) {
                $cekUser = DB::table('users_activated')->where('remember_token', 'like', '%' . $token . '%')->take(1)->delete();
                echo 'your acccount already active, you can login now';
            } else {
                echo 'data not found';
            }
        } else {
            echo 'data not found please contact your admin';
        }
    }

}
