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
    return view('welcome');
});


// Admin Group
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'localization'], function() {
    Route::resources([
        '/' => 'AdminController',
        'user' => 'UserController',
        'my_news' => 'MyNewController',
        'tags' => 'MyTagController',
        'news' => 'NewController'
    ]);

    Route::get('profile/{admin}','AdminController@show')->name('admin.show');
    Route::get('change-language/{language}', 'AdminController@changeLanguage')->name('change-language');
    Route::get('register', 'AdminController@create')->name('register');
    Route::get('download/{picture}','AdminController@download')->name('admin.download');
    Route::get('login', 'AdminController@login')->name('admin.index');
    Route::post('login', 'AdminController@postLogin')->name('admin.login');
    Route::post('logout', 'AdminController@logout')->name('admin.logout');
    Route::get('search', 'NewController@search');
});

// Route::get('/news/delete/{news}', 'NewController@delete');

//Route::get('/news/{news}/edit', 'NewController@edit')->middleware('Role');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

