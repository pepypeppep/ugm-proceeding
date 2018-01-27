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
    return view('dashboard.proceeding.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/proceedings', 'HomeController@proceedings');
Route::get('/proceedings/post', 'HomeController@storeProceeding');
Route::get('/proceedings/{proceeding}', 'HomeController@findProceeding');
Route::get('/users', 'HomeController@apiService');
Route::get('/users/{user}', 'HomeController@findUser');

Route::get('/try-login', 'LoginController@store');