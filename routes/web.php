<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Redes Sociales Login

Route::get('/facebook/login', 'FacebookLoginController@redirectToProvider');

Route::get('/facebook/callback', 'FacebookLoginController@handleProviderCallback');

Route::get('/twitter/login', 'TwitterLoginController@redirectToProvider');

Route::get('/twitter/callback', 'TwitterLoginController@handleProviderCallback');

Route::get('/google/login', 'GoogleLoginController@redirectToProvider');

Route::get('/google/callback', 'GoogleLoginController@handleProviderCallback');