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
Route::post('{post}/comment','CommentsController@postComment')->name('blog.post-comment');
Route::get('category/{category}','BlogController@category')->name('blog.category');
Route::get('author/{author}', 'BlogController@author')->name('blog.author');
Route::get('tag/{tag}', 'BlogController@tag')->name('blog.tag');

Route::group(['prefix' => 'backend', 'as' => 'backend.'], function(){
    Route::put('blog/restore/{blog}', 'Backend\BlogController@restore')->name('blog.restore');
    Route::delete('blog/force-delete/{blog}', 'Backend\BlogController@forceDelete')->name('blog.force-delete');
    Route::resource('blog', 'Backend\BlogController');
    Route::resource('categories', 'Backend\CategoriesController');
    Route::resource('users', 'Backend\UsersController');
    Route::get('profile', 'Backend\HomeController@editProfile');
    Route::put('profile', 'Backend\HomeController@updateProfile');
    Route::get('users/{id}/confirm-delete', 'Backend\UsersController@confirmDelete')->name('users.confirm-delete');
});

