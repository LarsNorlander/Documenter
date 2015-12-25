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

Route::get('/Contact', function(){
    return view('contact');
});

Route::post('/upload', function(){
    return ("Functionality to be encoded soon...");
});

Route::post('/login', 'Auth\AuthController@postLogin');
Route::get('/logout', 'Auth\AuthController@getLogout');

Route::get('/dashboard', 'FileDisplayController@index');