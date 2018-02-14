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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/users', 'HomeController@apiService');
Route::get('/users/{user}', 'HomeController@findUser');

Route::get('/try-login', 'LoginController@store');

Route::group(['prefix' => 'proceedings'], function(){
	Route::get('/', 'Admin\ProceedingController@index')->name('proceeding.index');
	Route::get('/create', 'Admin\ProceedingController@create')->name('proceeding.create');
	Route::get('/{proceeding}', 'Admin\ProceedingController@show')->name('proceeding.show');
	Route::get('/{proceeding}/edit', 'Admin\ProceedingController@edit')->name('proceeding.edit');
	Route::put('/{proceeding}', 'Admin\ProceedingController@update')->name('proceeding.update');
	Route::put('/{proceeding}/subjects', 'Admin\ProceedingController@updateSubjects')->name('proceeding.update.subjects');
	Route::post('/{proceeding}/cover', 'Admin\ProceedingController@updateCover')->name('proceeding.cover');
	Route::get('/{proceeding}/create-article', 'Admin\ArticleController@create')->name('article.create');
	Route::post('/', 'Admin\ProceedingController@store')->name('proceeding.store');
});

Route::group(['prefix' => 'articles'], function(){
	Route::post('/', 'Admin\ArticleController@store')->name('article.store');
	Route::get('/{article}', 'Admin\ArticleController@show')->name('article.show');
	Route::get('/{article}/edit', 'Admin\ArticleController@edit')->name('article.edit');
});

Route::get('/token', function ()
{
	return session('api_token');
});

