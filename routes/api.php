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
	});

});

Route::get('/articles', 'Api\ArticleController@index');