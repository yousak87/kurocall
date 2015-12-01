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
    Auth,
    Session;

class InsertController extends Controller {

    //put your code here

    public function signup() {
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
        $data['_token'] = mt_rand(1000000000000, 100000000000000000);
        if ($cekUser > 0) {
            return Redirect::to('signup')->withErrors('User already exist please use another email or click forget password');
        }
        $sent = Mail::send('emails.token_user', $data, function($message) use ($data) {
                    $message->from('beni.santoso@1rstwap.com');
                    $message->to($data['Email'], $data['Name'])->subject('Welcome to KuroCall ,Please Active Your Account!');
                });
        if (!$sent) {
            return Redirect::to('signup')->withErrors('Fail to sent email');
        } else {
            $data['Password'] = Crypt::encrypt($data['Password']);
            DB::table('users')->insert(
                    ['name' => $data['Name'],
                        'password' => $data['Password'],
                        'sex' => $data['Sex'],
                        'active' => 0,
                        'level' => 3,
                        'email' => $data['Email'],
                        'created_at' => date('Y-m-d H:i:s')
                    ]
            );
            DB::table('users_activated')->insert(
                    ['remember_token' => $data['_token'],
                        'email' => $data['Email']
                    ]
            );
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
        );
        //dd($userdata);
        // attempt to do the login
        switch ($this->cekUser($userdata)) {
            case '0' : return Redirect::to('login')->withErrors('error : account not found');
                break;
            case '2' : return Redirect::to('login')->withErrors('error : please active your account first to login');
                break;
            case '3' : return Redirect::to('login')->withErrors('error : combination email and password is not right');
                break;
            case '1' : return Redirect::to('home');
                break;
            default : return Redirect::to('login')->withErrors('error : something wrong');
                break;
        }
    }

    public function cekUser($userdata) {

        $cekUser = DB::table('users')->where('email', '=', $userdata['email'])->get();
        //dd(Crypt::decrypt($cekUser[0]->password));
        if (!$cekUser) {
            return '0';
        } elseif ($cekUser[0]->active == 0) {
            return '2';
        } elseif (Crypt::decrypt($cekUser[0]->password) != Crypt::decrypt($userdata['password'])) {
            echo '3';
        } else {
            Session::put('name', $cekUser[0]->name);
            Session::put('email', $cekUser[0]->email);
            Session::put('token', $cekUser[0]->password);
            Session::put('password', $cekUser[0]->password);
            Session::put('level', $cekUser[0]->level);
            Session::put('greting', "1");


            return '1';
        }
    }

    public function activeUser($token) {

        $cekUser = DB::table('users_activated')->where('remember_token', '=', $token)->take(1)->get();

        if ($cekUser) {
            $change = DB::table('users')->where('email', '=', $cekUser[0]->email)->update(array('active' => 1));
            if ($change) {
                $cekUser = DB::table('users_activated')->where('remember_token', 'like', '%' . $token . '%')->take(1)->delete();
                return Redirect::to('login')->with('status', 'Succes your account already active, you can login now');
            } else {
                return Redirect::to('login')->withErrors('data not found please contact your admin');
            }
        } else {
            return Redirect::to('login')->withErrors('data not found please contact your admin');
        }
    }

    public function resetUserPass() {

        $data = Input::all();
        $data['link'] = asset('/') . 'reset';
        $rules = array(
            'email' => 'required'
        );
        $data['_token'] = mt_rand(1000000000000, 100000000000000000);
        ;
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return Redirect::to('login')->withErrors($validator)->withInput();
        }

        $cekUser = DB::table('users')->where('email', '=', $data['email'])->count();

        if ($cekUser > 0) {
            DB::table('password_resets')->insert(
                    [
                        'token' => $data['_token'],
                        'email' => $data['email'],
                        'created_at' => date('Y-m-d H:i:s'),
                    ]
            );
            $sent = Mail::send('emails.password', $data, function($message) use ($data) {
                        $message->from('beni.santoso@1rstwap.com');
                        $message->to($data['email'], 'Admin')->subject('Reset Password KuroCall Account!');
                    });

            if ($sent) {
                return Redirect::to('login')->with('status', 'Succes the link for reset password already send to your email ');
            } else {
                return Redirect::to('login')->withErrors('Fail to send email, please contact your administrator');
            }
        } else {
            return Redirect::to('login')->withErrors('your email not exist in our data, please signup');
        }
    }

    public function reset($token) {
        $cekUser = DB::table('password_resets')->where('token', '=', $token)->get();
        if ($cekUser) {

            $day1 = $cekUser[0]->created_at;
            $day1 = strtotime($day1);
            $day2 = date('Y-m-d H:i:s');
            $day2 = strtotime($day2);

            $diffHours = (int) ceil(($day2 - $day1) / 3600);
            if ($diffHours > 5) {
                return Redirect::to('login')->withErrors('Error : your link reset password alredy expired ,please request link again');
            } else {
                return view('reset', ['token' => $cekUser]);
            }
        }
    }

    public function resetUserPassEnd() {
        $data = Input::all();
        $rules = array(
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        );

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return Redirect::action('InsertController@reset', $data['token'])->withErrors($validator);
            //return Redirect::to('reset')->withErrors($validator)->withInput(Input::get());
        }
        $cekUser = DB::table('password_resets')->where('token', '=', $data['token'])->get();
        if ($cekUser) {

            $day1 = $cekUser[0]->created_at;
            $day1 = strtotime($day1);
            $day2 = date('Y-m-d H:i:s');
            $day2 = strtotime($day2);

            $diffHours = (int) ceil(($day2 - $day1) / 3600);
            if ($diffHours > 5) {
                return Redirect::to('login')->withErrors('Error : your link reset password alredy expired ,please request link again');
            } else {
                $change = DB::table('users')->where('email', '=', $data['email'])->update(array('password' => Crypt::encrypt($data['password'])));
                if ($change) {
                    $cekUser = DB::table('password_resets')->where('token', 'like', '%' . $data['token'] . '%')->take(1)->delete();
                    return Redirect::to('login')->with('status', 'Succes your already reset your password');
                } else {
                    return Redirect::to('login')->withErrors('data not found please contact your admin');
                }
            }
        }
    }

    public function addAdmin() {
        $data = Input::all();
        $rules = array(
            'Name' => 'required',
            'Password' => 'required',
            'RetypePassword' => 'required|same:Password',
            'Sex' => 'required',
            'Email' => 'required|email'
        );

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return Redirect::to('addAdmin')->withErrors($validator)->withInput();
        }

        $cekUser = DB::table('users')->where('email', '=', $data['Email'])->count();

        if ($cekUser > 0) {
            return Redirect::to('addAdmin')->withErrors('User already exist please use another email or click forget password');
        }

        $data['Password'] = Crypt::encrypt($data['Password']);
        DB::table('users')->insert(
                ['name' => $data['Name'],
                    'password' => $data['Password'],
                    'sex' => $data['Sex'],
                    'active' => 0,
                    'level' => 2,
                    'email' => $data['Email'],
                    'created_at' => date('Y-m-d H:i:s')
                ]
        );

        return Redirect::to('addAdmin')->with('status', 'Succes create user admin ');
    }

    public function addNewPages() {
        $data = Input::all();
        if (Input::file('image') != "") {
            if (Input::file('image')->isValid()) {
                $destinationPath = base_path() . '/public/upload/';
                $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
                $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
                Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
            }
        }else{$fileName="";}
        if (Input::file('header') != "") {
        if (Input::file('header')->isValid()) {
            $destinationPath = base_path() . '/public/upload/';
            $extension = Input::file('header')->getClientOriginalExtension(); // getting image extension
            $fileName2 = rand(11111, 99999) . '.' . $extension; // renameing image
            Input::file('header')->move($destinationPath, $fileName2); // uploading file to given path
        }       
        }else{
            $fileName2="";
        }





        $insert = DB::table('pages')->insert(
                [
                    'title' => $data['title'],
                    'content' => $data['content'],
                    'slug' => $data['slug'],
                    'image' => $fileName = "" ? "" : $fileName,
                    'header_img' => $fileName = "" ? "" : $fileName2,
                    'parent_id' => $data['parent_id'],
                    'brief' => $data['brief'],
                    'description' => $data['description'],
                    'keywords' => $data['keyword'],
                ]
        );

        if ($insert) {
            return Redirect::to('/addNewPages')->with('status', 'Succes create new pages ');
        } else {
            return Redirect::to('/addNewPages')->withErrors('data failed to save');
        }
    }

}
