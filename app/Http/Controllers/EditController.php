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

        $cekUser = DB::table('users')->where('email', '=', $data['Email'])->where('id','<>',$data['id'])->count();

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
        DB::table('users')->where('id', '=', $data['id'])->update(array('email' => $data['Email'],'name'=>$data['Name'],'sex'=>$data['Sex']));
        
        return Redirect::to('home')->with('status','Success data already change');
    }

    


}
