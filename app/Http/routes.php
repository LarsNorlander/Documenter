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

Route::get('/', function () {
    if(Auth::check())
        return redirect('/dashboard');
    else
        return view('welcome');
});

Route::post('/login', 'Auth\AuthController@postLogin');
Route::get('/logout', 'Auth\AuthController@getLogout');

Route::post('/upload', 'FileController@addFile');
Route::get('/dashboard', 'FileController@viewFiles');
Route::get('/file/details/{id}', 'FileController@getDetails');

Route::get('/admin', 'AdminController@index');
Route::get('/admin/depts', 'AdminController@depts');
Route::post('/admin/add/dept', 'AdminController@addDepts');
Route::get('/admin/del/dept/{id}', 'AdminController@delDepts');