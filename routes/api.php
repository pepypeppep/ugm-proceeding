<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/find-user', 'Api\AuthUsersController@show');

Route::group(['prefix' => 'user', 'middleware' => 'auth:api'], function(){
	Route::get('/', 'Api\UserController@index');;
	Route::get('/{user}', 'Api\UserController@show');
});

Route::post('/login', 'Api\LoginController@store');

Route::group(['prefix' => 'proceedings'], function(){
	Route::get('/', 'Api\ProceedingController@index');
	Route::get('/{proceeding}', 'Api\ProceedingController@show');
	
	Route::middleware(['auth:api'])->group(function ()
	{
		Route::post('/', 'Api\ProceedingController@store');
		Route::put('/{proceeding}', 'Api\ProceedingController@update');
		Route::put('/{proceeding}/subjects', 'Api\ProceedingController@updateSubjects');
		Route::post('/{proceeding}/covers', 'Api\ProceedingController@updateCovers');
		Route::post('/publish', 'Api\PublishProceedingController@store');
	});
});

Route::group(['prefix' => 'books'], function(){
	Route::get('/', 'Api\BookController@index');
	Route::get('/{book}', 'Api\BookController@show');
	Route::get('/{book}/download', 'Api\BookController@showFile')->name('api.book.download');
	
	Route::group(['middleware' => 'auth:api'], function(){
		Route::post('/', 'Api\BookController@store');
		Route::post('/{book}/author', 'Api\BookController@storeAuthor');
		Route::post('/{book}/file', 'Api\BookController@storeFile');
		Route::post('/{book}/cover', 'Api\BookController@storeCover');
	});
});

Route::group(['prefix' => 'articles'], function(){
	Route::get('/', 'Api\ArticleController@index');
	Route::get('/{article}', 'Api\ArticleController@show');
	Route::middleware(['auth:api'])->group(function ()
	{
		Route::post('/', 'Api\ArticleController@store');
		Route::put('/{article}', 'Api\ArticleController@update');
		Route::post('/{article}/file', 'Api\IndexationController@update');
	});
});

Route::group(['prefix' => 'subjects'], function(){
	Route::get('/', 'Api\SubjectController@index');
	Route::get('/{subject}', 'Api\SubjectController@show');
});

Route::group(['prefix' => 'institutions'], function(){
	Route::get('/', 'Api\InstitutionController@index');
	Route::get('/{institution}', 'Api\InstitutionController@show');
});

Route::group(['prefix' => 'authors'], function(){
	Route::get('/', 'Api\AuthorController@index');
	Route::group(['middleware' => 'auth:api'], function(){
		Route::put('/{author}', 'Api\AuthorController@update');
	});
});
