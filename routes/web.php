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

//Auth::routes(['register' => false]);
Auth::routes();

Route::group(['middleware'=>'auth'], function () {
    Route::get('/', 'HomeController@welcome')->name('welcome');
    Route::get('/home', 'HomeController@index')->name('home');


    Route::get('change_password', 'Auth\ChangePasswordController@index')->name('change_password');
    Route::post('change_password', 'Auth\ChangePasswordController@store')->name('store_password');
});


Route::group(['middleware'=>['auth', 'isAdmin']], function() {
    Route::get('/user', 'Auth\UserController@index')->name('auth.users');
});
