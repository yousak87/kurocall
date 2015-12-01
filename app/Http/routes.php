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


//user
Route::get('/','PagesController@landing');
Route::get('home','PagesController@home');

Route::get('active/{token}', 'InsertController@activeUser');

Route::get('reset/{token}', 'InsertController@reset');
Route::post('reset', 'InsertController@resetUserPass');
Route::post('endReset', 'InsertController@resetUserPassEnd');



Route::get('password', 'PagesController@password');

Route::get('signup', 'PagesController@signup');
Route::post('signup', 'InsertController@signup');

Route::get('login', 'PagesController@login');
Route::post('login', 'InsertController@doLogin');

Route::get('logout', 'PagesController@logout');

Route::get('sub', 'PagesController@sub');
Route::get('ava', 'PagesController@ava');

Route::get('bill', 'PagesController@bill');
Route::get('usage/{app_id}', 'PagesController@usage');

Route::get("/api","ApiController@index");
Route::get("/api/subscriptions","ApiController@subscriptions");
Route::get("/api/available_apps","ApiController@available_apps");
Route::get("/api/plan/{id}","ApiController@plan");
Route::get("/api/activity/{app_id}","ApiController@activity");
Route::get("/api/usage/{app_id}","ApiController@usage");
Route::get("/api/billing","ApiController@billing");
//Route::post('signup','Auth\AuthController@postRegister');

//Route::controllers([
//    'auth' => 'Auth\AuthController',
//    'password' => 'Auth\PasswordController',
//]);

//Route::get('/', [
//    'middleware' => 'auth',
//    'uses' => 'PagesController@login'
//]);

//Route::get('home', [
//    'middleware' => 'auth',
//    'uses' => 'PagesController@home'
//]);

//Route::get('tes',function(){
//    $encrypted = Crypt::encrypt('secret');
//    $decr=  Crypt::decrypt($encrypted);
//    echo $encrypted;
//    echo '<br>'.$decr;
//});
//
//
//$encrypted = Crypt::encrypt('secret');

//admin
Route::get('editUser/{id}', 'PagesController@editUser');
Route::post('editUser', 'EditController@editUser');

Route::get('deleteUser/{id}', 'PagesController@deleteUser');
Route::post('deleteUser', 'DeleteController@deleteUser');

Route::get('addAdmin', 'PagesController@addAdmin');
Route::post('addAdmin', 'InsertController@addAdmin');

Route::get('addPages', 'PagesController@addPages');

Route::get('addNewPages', 'PagesController@addNewPages');
Route::post('addNewPages', 'InsertController@addNewPages');

Route::get('editPages/{id}', 'PagesController@editPages');
Route::post('editPages', 'EditController@editPages');

Route::get('deletePages/{id}', 'PagesController@deletePages');
Route::post('deletePages', 'DeleteController@deletePages');


Route::get('tes', 'PagesController@tes');
