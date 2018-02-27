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

Auth::routes();

// Route::get('/', function ()
// {
//     return view('public.home.index');
// });

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/users', 'HomeController@apiService');
Route::get('/users/{user}', 'HomeController@findUser');

Route::get('/', 'Site\ProceedingController@index')->name('public.index');
Route::get('/{article}', 'Site\ArticleController@show')->name('public.article.show');