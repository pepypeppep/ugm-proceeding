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

Route::get('/redirect', function () {
    $query = http_build_query([
        'client_id' => 4,
        'redirect_uri' => 'http://localhost:8000/callback',
        'response_type' => 'code',
        'scope' => '',
    ]);

    return redirect('http://localhost:8000/oauth/authorize?'.$query);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/proceedings', 'HomeController@proceedings');
Route::get('/users', 'HomeController@apiService');
Route::get('/users/{user}', 'HomeController@findUser');

Route::get('/try-login', 'LoginController@store');