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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/search', 'SearchController@users');

Route::resource('/users', 'UsersController', ['except' => ['index', 'create', 'store', 'destroy']]);

Route::get('/images/user-avatar/{id}/{size}', 'ImagesController@user_avatar');

//Route::resource('/friends', 'FriendsController', ['except' => ['create', 'show', 'edit']]);
Route::get('users/{user}/friends', 'FriendsController@index');
Route::post('/friends/{friend}', 'FriendsController@add');
Route::patch('/friends/{friend}', 'FriendsController@accept');
Route::delete('/friends/{friend}', 'FriendsController@destroy');
