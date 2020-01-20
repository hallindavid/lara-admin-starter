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

//Just needs to be logged in.
Route::group(['middleware'=>['auth:api']], function () {
    //Organization Management
    Route::get('my-organizations', 'User\OrganizationController@my_organizations')->name('api.my-organizations');
    Route::post('store-organization', 'User\OrganizationController@store_organization')->name('api.store-organization');
    Route::post('switch-organization', 'User\OrganizationController@switch_organization')->name('api.switch-organization');
    Route::delete('leave-organization/{org}', 'User\OrganizationController@leave_organization')->name('api.leave-organization');

    Route::patch('accept_invitation/{invite}', 'User\OrganizationController@accept_invitation');
    Route::patch('decline_invitation/{invite}', 'User\OrganizationController@decline_invitation');

    //Preferences
    Route::post('update_preferences', 'Auth\UpdatePreferencesController@update_preferences')->name('api.update_preferences');
});


Route::group(['middleware'=>['auth:api', 'can:manage-users'], 'prefix'=>'org'], function () {    
    Route::post('user/send_invite', 'OrgAdmin\UsersController@send_invite')->name('api.org_admin.users.send_invite');
    Route::delete("user/{user}", 'OrgAdmin\UsersController@destroy')->name('api.org_admin.users.destroy');
    Route::delete("invites/{invite}", 'OrgAdmin\UsersController@destroy_invitation')->name('api.org_admin.users.destroy_invitation');
    Route::post('user/{user}/toggle_permission', 'OrgAdmin\UsersController@toggle_permission')->name('api.org_admin.users.toggle_permission');
    Route::get('user/{user}', 'OrgAdmin\UsersController@show')->name('api.org_admin.users.show');
});

Route::group(['middleware'=>['auth:api','isAdmin'], 'prefix'=>'admin'], function () {
    Route::get('user/{user}/organizations','Admin\UserController@organizations')->name('api.admin.user.organizations');
    Route::patch('user/{user}', 'Admin\UserController@update')->name('api.admin.user.update');
    Route::delete('user/{user}', 'Admin\UserController@destroy')->name('api.admin.user.destroy');
    Route::get('user/{user}', 'Admin\UserController@show')->name('api.admin.user.show');
    Route::post('user', 'Admin\UserController@store')->name('api.admin.user.store');
    Route::get('user', 'Admin\UserController@api_index')->name('api.admin.user.index');
    Route::resource('organization', 'Admin\OrganizationApiController');
});
