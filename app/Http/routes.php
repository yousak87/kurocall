<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

Route::get('/', [
    'middleware' => 'auth',
    'uses' => 'PagesController@login'
]);

Route::get('home','PagesController@home');

//Route::get('home', [
//    'middleware' => 'auth',
//    'uses' => 'PagesController@home'
//]);
Route::get('password', 'PagesController@password');


//Route::controllers([
//    'auth' => 'Auth\AuthController',
//    'password' => 'Auth\PasswordController',
//]);
Route::get('signup', 'PagesController@signup');
//Route::post('signup','Auth\AuthController@postRegister');
Route::post('signup', 'InsertController@signup');

Route::get('login', 'PagesController@login');
Route::post('login', 'InsertController@doLogin');


Route::get('active/{token}', 'InsertController@activeUser');


Route::get('editUser/{id}', 'PagesController@editUser');
Route::post('editUser', 'EditController@editUser');

Route::get('deleteUser/{id}', 'PagesController@deleteUser');
Route::post('deleteUser', 'DeleteController@deleteUser');


//Route::get('tes',function(){
//    $encrypted = Crypt::encrypt('secret');
//    $decr=  Crypt::decrypt($encrypted);
//    echo $encrypted;
//    echo '<br>'.$decr;
//});
//
//
//$encrypted = Crypt::encrypt('secret');

Route::get('tes', 'PagesController@tes');
