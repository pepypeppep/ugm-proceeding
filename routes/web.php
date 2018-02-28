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

/* PUBLIC ROUTES */
Route::get('/', 'Site\HomeController@index')->name('public.index');
Route::get('/article/{article}', 'Site\ArticleController@show')->name('public.article.show');
Route::get('/proceedings', 'Site\ProceedingController@index')->name('public.proceeding.index');
Route::get('/proceeding/{proceeding}', 'Site\ProceedingController@show')->name('public.proceeding.show');
Route::get('/books', 'Site\BookController@index')->name('public.book.index');
Route::get('/book/{book}', 'Site\BookController@show')->name('public.book.show');