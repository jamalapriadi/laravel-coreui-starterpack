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
    return view('auth.login');
});

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'data','middleware'=>'auth'],function(){
    /**User */
    Route::resource('users','User\UserController');
    Route::get('user','User\UserController@login_info');
    Route::post('update-foto','User\UserController@update_foto');
    Route::post('update-info','User\UserController@update_info');
    Route::resource('roles','User\RoleController');
    Route::get('list-role','User\RoleController@list_role');
    Route::resource('permissions','User\PermissionController');
    Route::get('list-permission','User\PermissionController@list_permission');
    Route::post('save-permission-role/{id}','User\PermissionController@save_permission_role');
    Route::get('list-role-with-permission/{id}','User\RoleController@list_role_with_permission');
    Route::get('list-role-user','User\UserController@list_role');
    Route::post('save-role-user','User\UserController@save_role_user');
    Route::post('hapus-role-user','User\UserController@hapus_role_user');
    Route::post('change-password','User\UserController@change_password');
    Route::post('users/{user}/follow', 'User\UserController@follow')->name('follow');
    Route::delete('users/{user}/unfollow', 'User\UserController@unfollow')->name('unfollow');
    Route::get('notifications', 'User\UserController@notifications');
    Route::get('status-user/{id}','User\UserController@status_user');
    Route::post('update-role-user/{id}','User\UserController@update_role_user');
    /**End User */
});