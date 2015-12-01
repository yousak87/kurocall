<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Validator,
    Input,
    Redirect,
    Hash;

class DeleteController extends Controller {

    public function deleteUser() {
        $data = Input::all();
        $cekUser = DB::table('users')->where('id', '=', $data['id'])->count();

        if ($cekUser > 0) {
            DB::table('users')->where('id', '=', $data['id'])->delete();
            return Redirect::to('/home')->with('status', 'Succes delete user data ');
        }
        return Redirect::to('home')->withErrors('Error User Not Found');
    }
    public function deletePages() {
        $data = Input::all();
        $cekUser = DB::table('pages')->where('id', '=', $data['id'])->count();

        if ($cekUser > 0) {
            DB::table('pages')->where('id', '=', $data['id'])->delete();
            return Redirect::to('/addPages')->with('status', 'Succes delete data ');
        }
        return Redirect::to('/addPages')->withErrors('Error User Not Found');
    }

}
