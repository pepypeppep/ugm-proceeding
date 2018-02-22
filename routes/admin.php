<?php

Route::get('/', function ()
{
    return redirect(route('home.index'));
});

Route::group(['prefix' => 'home'], function(){
    Route::get('/', 'Admin\HomeController@index')->name('home.index');
});

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
    Route::post('/publish', 'Admin\ProceedingController@publish')->name('proceeding.publish');
});

Route::group(['prefix' => 'articles'], function(){
    Route::post('/', 'Admin\ArticleController@store')->name('article.store');
    Route::get('/{article}', 'Admin\ArticleController@show')->name('article.show');
    Route::get('/{article}/edit', 'Admin\ArticleController@edit')->name('article.edit');
});
