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
Route::get('/', 'BlogController@index')->name('blog');
Route::get('home', 'Backend\HomeController@index')->name('home');
Route::get('logout', 'Auth\LoginController@logout');

Route::get('{post}','BlogController@show')->name('blog.show');
Route::get('category/{category}','BlogController@category')->name('blog.category');
Route::get('author/{author}', 'BlogController@author')->name('blog.author');

Route::group(['prefix' => 'backend', 'as' => 'backend.'], function(){
    Route::resource('blog', 'Backend\BlogController');
});

