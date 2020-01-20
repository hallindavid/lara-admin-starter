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


Route::get('google_login', 'Auth\SocialAuthGoogleController@redirectToProvider')->name('google_login');
Route::get('google_login/callback', 'Auth\SocialAuthGoogleController@handleProviderCallback')->name('google_login.callback');
Auth::routes(['verify' => true]);

//Admin Namespace - Must be Site Administrator to Access
Route::group(['middleware'=>['auth','verified','isAdmin'], 'prefix'=>'admin'], function () {
    Route::get('users', 'Admin\UserController@index')->name('admin.users');
    Route::get('organizations', 'Admin\OrganizationController@index')->name('admin.organizations');
    Route::get('system', 'Admin\SystemAdminController@index')->name('admin.system');
    Route::post('reset_system', 'Admin\SystemAdminController@reset_system')->name('admin.reset_system');
    Route::post('activate_demo_users', 'Admin\SystemAdminController@activate_demo_users')->name('admin.activate_demo_users');
});

// //Org Admin Namespace - Function/Routes which are only available to Organization Owners/Administrators
Route::group(['middleware'=>['auth','verified','orgAdmin'],'prefix'=>'org'], function () {
    Route::get('users', 'OrgAdmin\UsersController@index')->name('org_admin.users.index');

}); //END OF ORG ADMIN MIDDLEWARE GROUP


Route::group(['middleware'=>['auth','verified']], function () {
    //Users's Org Management - Change/Create Org
    Route::get('change_org', 'User\OrganizationController@change_org')->name('change_org');
    Route::get('new_org', 'User\OrganizationController@new_org')->name('new_org');
    Route::get('get_started', 'User\MainController@get_started')->name('get_started');
    
    
    
    //User should be logged in, but not necessarily verified to perform these functions
    Route::get('change_password', 'Auth\ChangePasswordController@index')->name('change_password');
    Route::post('change_password', 'Auth\ChangePasswordController@store')->name('store_password');
    Route::get('update_preferences', 'Auth\UpdatePreferencesController@index')->name('update_preferences');
    Route::get('set_preferences', 'Auth\UpdatePreferencesController@set_initial_preferences')->name('set_preferences');
    
    Route::get('/dashboard', 'User\MainController@dashboard')->name('user.dashboard');
}); //End of AUTH middleware group

Route::redirect('/', '/dashboard');
