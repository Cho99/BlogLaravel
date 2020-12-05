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
    return redirect()->route('news.index');
});

Route::resource('/news', 'NewController');
Route::get('/search', 'NewController@search');
Route::get('/news/delete/{news}', 'NewController@delete');

Route::resource('/my_news', 'MyNewController');
//Route::get('/news/{news}/edit', 'NewController@edit')->middleware('Role');
Route::resource('/tags', 'MyTagController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

