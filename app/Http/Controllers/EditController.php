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

class EditController extends Controller {

    public function editUser() {
        $data = Input::all();
        $rules = array(
            'Name' => 'required',
            'Sex' => 'required',
            'Email' => 'required|email'
        );

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $cekUser = DB::table('users')->where('email', '=', $data['Email'])->where('id', '<>', $data['id'])->count();

        if ($cekUser > 0) {

            //die();
            return Redirect::back()->withErrors('email already use by another users ,please use another email');
        }

//        DB::table('users')->insert(
//                ['f_name' => $data['FirstName'],
//                    'l_name' => $data['LastName'],
//                    'password' => bcrypt($data['Password']),
//                    'sex' => $data['Sex'],
//                    'email' => $data['Email']
//                ]
//        );
        DB::table('users')->where('id', '=', $data['id'])->update(array('email' => $data['Email'], 'name' => $data['Name'], 'sex' => $data['Sex']));

        return Redirect::to('home')->with('status', 'Success data already change');
    }

    public function editPages() {
        $data = Input::all();

        if (Input::file('image') != "") {
            if (Input::file('image')->isValid()) {
                $destinationPath = base_path() . '/public/upload/';
                $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
                $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
                Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
            }
        } else {
            $fileName = "";
        }
        if (Input::file('header') != "") {
            if (Input::file('header')->isValid()) {
                $destinationPath = base_path() . '/public/upload/';
                $extension = Input::file('header')->getClientOriginalExtension(); // getting image extension
                $fileName2 = rand(11111, 99999) . '.' . $extension; // renameing image
                Input::file('header')->move($destinationPath, $fileName2); // uploading file to given path
            }
        } else {
            $fileName2 = "";
        }
        $dataUpdate = [
            'title' => $data['title'],
            'content' => $data['content'],
            'slug' => $data['slug'],
            'image' => $fileName = "" ? "" : $fileName,
            'header_img' => $fileName = "" ? "" : $fileName2,
            'parent_id' => $data['parent_id'],
            'brief' => $data['brief'],
            'description' => $data['description'],
            'keywords' => $data['keyword'],
        ];
        if ($fileName == "") {
            unset($dataUpdate['image']);
        }
        if ($fileName2 == "") {
            unset($dataUpdate['header_img']);
        }


        $insert = DB::table('pages')->where('id', '=', $data['id'])->update(
                $dataUpdate
        );

        if ($insert) {
            return Redirect::to('/addPages')->with('status', 'Succes edit data ');
        } else {
            return Redirect::to('/editPages/'.$data['id'])->withErrors('data failed to save');
        }
    }

}
