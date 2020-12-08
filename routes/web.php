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


// Admin Group
Route::group(['prefix' => 'admin'], function() {
    Route::resource('/', 'Admin\MyAdminController');
    Route::resource('user','Admin\UserController');
    Route::resource('my_news', 'Admin\MyNewController');
    Route::resource('tags', 'Admin\MyTagController');
    Route::resource('news', 'Admin\NewController');
});


Route::get('/search', 'NewController@search');
Route::get('/news/delete/{news}', 'NewController@delete');

//Route::get('/news/{news}/edit', 'NewController@edit')->middleware('Role');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

