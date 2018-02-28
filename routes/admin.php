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
    Route::put('/{article}', 'Admin\ArticleController@update')->name('article.update');
});

Route::group(['prefix' => 'books'], function(){
    Route::get('/', 'Admin\BookController@index')->name('book.index');
    Route::get('/create', 'Admin\BookController@create')->name('book.create');
    Route::get('/{book}', 'Admin\BookController@show')->name('book.show');
    Route::post('/', 'Admin\BookController@store')->name('book.store');
    Route::get('/{book}/edit', 'Admin\BookController@edit')->name('book.edit');
    Route::post('/{book}/author', 'Admin\BookController@storeAuthor')->name('book.store.author');
});

Route::group(['prefix' => 'authors'], function(){
    Route::put('/{author}', 'Admin\AuthorController@update')->name('author.update');
});

