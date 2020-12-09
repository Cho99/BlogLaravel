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
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {
    Route::resource('/', 'MyAdminController');
    Route::get('login', 'MyAdminController@login');
    Route::post('login', 'MyAdminController@postLogin')->name('admin.login');
    Route::resource('user','UserController');
    Route::resource('my_news', 'MyNewController');
    Route::resource('tags', 'MyTagController');
    Route::resource('news', 'NewController');
    Route::get('/search', 'NewController@search');
});



// Route::get('/news/delete/{news}', 'NewController@delete');

//Route::get('/news/{news}/edit', 'NewController@edit')->middleware('Role');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

