<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/




Route::group(['middleware'=>['auth:api','isAdmin']], function () {
    Route::resource('user', 'Api\UsersController');
    Route::get('permissions','Api\PermissionsController@index');
    Route::post('userpermissions','Api\UserPermissionsController@index');


    Route::post('user/{user}/permissions', 'API\UserPermissionsController@update')->name('user.permissions.update');
});
