<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Validator,
    Form,
    Helper,
    Input,
    Redirect,
    Hash,
    Crypt,
    Mail,
    Auth,
    Session;

class PagesController extends Controller {

    public function home() {

        if (Session::get('token') == '') {
            return Redirect::to('login')->withErrors('Error : Please Login First');
        } elseif (Session::get('password') == '') {
            return Redirect::to('login')->withErrors('Error : Please Login First');
        } elseif (Session::get('token') != Session::get('password')) {
            return Redirect::to('login')->withErrors('Error : Please Login First');
        } else {
            if (Session::get('level') == 1) {
                $users = DB::table('users')->paginate(10);
                return view('home', ['users' => $users]);
            } elseif (Session::get('level') == 2) {
                $users = DB::table('users')->where('level', '<>', 1)->paginate(2);
                return view('home', ['users' => $users]);
            } else {
                $users = DB::table('users')->paginate(10);
                return view('dashboard', ['users' => $users]);
            }
        }
    }

    public function sub() {

        if (Session::get('token') == '') {
            return Redirect::to('login')->withErrors('Error : Please Login First');
        } elseif (Session::get('password') == '') {
            return Redirect::to('login')->withErrors('Error : Please Login First');
        } elseif (Session::get('token') != Session::get('password')) {
            return Redirect::to('login')->withErrors('Error : Please Login First');
        } else {


            return view('sub');
        }
    }

    public function ava() {

        if (Session::get('token') == '') {
            return Redirect::to('login')->withErrors('Error : Please Login First');
        } elseif (Session::get('password') == '') {
            return Redirect::to('login')->withErrors('Error : Please Login First');
        } elseif (Session::get('token') != Session::get('password')) {
            return Redirect::to('login')->withErrors('Error : Please Login First');
        } else {


            return view('ava');
        }
    }

    public function usage($app_id) {

        if (Session::get('token') == '') {
            return Redirect::to('login')->withErrors('Error : Please Login First');
        } elseif (Session::get('password') == '') {
            return Redirect::to('login')->withErrors('Error : Please Login First');
        } elseif (Session::get('token') != Session::get('password')) {
            return Redirect::to('login')->withErrors('Error : Please Login First');
        } else {

            $data['app_id'] = $app_id;
            return view('usage', ['datas' => $data]);
        }
    }

    public function bill() {

        if (Session::get('token') == '') {
            return Redirect::to('login')->withErrors('Error : Please Login First');
        } elseif (Session::get('password') == '') {
            return Redirect::to('login')->withErrors('Error : Please Login First');
        } elseif (Session::get('token') != Session::get('password')) {
            return Redirect::to('login')->withErrors('Error : Please Login First');
        } else {


            return view('bill');
        }
    }

    public function editUser($id) {
        $users = DB::table('users')->where('id', $id)->get();
        return view('editUser', ['users' => $users]);
    }

    public function deleteUser($id) {

        $users = DB::table('users')->where('id', $id)->get();
        return view('deleteUser', ['users' => $users]);
    }

    //USER
    public function login() {
        if (Session::get('token') != '') {
            return Redirect::to('home');
        }
        return view('login');
    }

    public function landing() {
        if (Session::get('token') != '') {
            return Redirect::to('home');
        }
        return view('landing');
    }

    public function logout() {
        Session::flush();
        return Redirect::to('login')->with('status', 'You already logout see you again nextime');
    }

    public function password() {
        return view('/auth/password');
    }

    public function signup() {
        if (Session::get('token') != '') {
            return Redirect::to('home');
        }
        return view('signup');
    }

    public function tes() {



        return view('calender');
    }

    public function addAdmin() {

        if (Session::get('token') == '') {
            return Redirect::to('login')->withErrors('Error : Please Login First');
        } elseif (Session::get('password') == '') {
            return Redirect::to('login')->withErrors('Error : Please Login First');
        } elseif (Session::get('token') != Session::get('password')) {
            return Redirect::to('login')->withErrors('Error : Please Login First');
        } else {
            if (Session::get('level') == 1) {
                return view('addAdmin');
            } else {
                $users = DB::table('users')->paginate(2);
                return Redirect::to('home');
            }
        }
    }

    public function addPages() {

        if (Session::get('token') == '') {
            return Redirect::to('login')->withErrors('Error : Please Login First');
        } elseif (Session::get('password') == '') {
            return Redirect::to('login')->withErrors('Error : Please Login First');
        } elseif (Session::get('token') != Session::get('password')) {
            return Redirect::to('login')->withErrors('Error : Please Login First');
        } else {
            if (Session::get('level') == 1 || Session::get('level') == 2) {
                $pages = DB::table('pages')->orderBy('id', 'desc')->paginate(5);

                return view('pagesList', ['pages' => $pages]);
            } else {

                return Redirect::to('home');
            }
        }
    }

    public function addNewPages() {

        if (Session::get('token') == '') {
            return Redirect::to('login')->withErrors('Error : Please Login First');
        } elseif (Session::get('password') == '') {
            return Redirect::to('login')->withErrors('Error : Please Login First');
        } elseif (Session::get('token') != Session::get('password')) {
            return Redirect::to('login')->withErrors('Error : Please Login First');
        } else {

            if (Session::get('level') == 1 || Session::get('level') == 2) {
                return view('newPage');
            } else {

                return Redirect::to('home');
            }
        }
    }

    public function editPages($id) {

        if (Session::get('token') == '') {
            return Redirect::to('login')->withErrors('Error : Please Login First');
        } elseif (Session::get('password') == '') {
            return Redirect::to('login')->withErrors('Error : Please Login First');
        } elseif (Session::get('token') != Session::get('password')) {
            return Redirect::to('login')->withErrors('Error : Please Login First');
        } else {

            if (Session::get('level') == 1 || Session::get('level') == 2) {
                $pages = DB::table('pages')->where('id', $id)->get();
                if ($pages) {
                    return view('editPages', ['pages' => $pages]);
                } else {
                    return Redirect::to('login')->withErrors('Error : data not found');
                }
            } else {

                return Redirect::to('home');
            }
        }
    }

    public function deletePages($id) {

        $pages = DB::table('pages')->where('id', $id)->get();
        return view('deletePages', ['pages' => $pages]);
    }

}
