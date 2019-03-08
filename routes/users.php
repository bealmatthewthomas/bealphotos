<?php
/**
 * Created by PhpStorm.
 * User: matthewtbeal
 * Date: 3/8/19
 * Time: 4:55 PM
 */

Route::get('/users', 'UsersController@index')
    ->name('users_index');

Route::get('/user/create', 'UsersController@create')
    ->middleware('auth','check_role:admin')
    ->name('user_create');

Route::post('/user/create/{admin_id?}', 'UsersController@store')
    ->middleware('auth','check_role:admin')
    ->name('user_store');

Route::get('/user/view/{user_id}', 'UsersController@view')
    ->name('user_view');

Route::post('user/edit', 'UsersController@edit')
    ->middleware('auth','check_role:admin')
    ->name('user_edit');

Route::post('user/delete/{user_id}', 'UsersController@delete')
    ->middleware('auth','check_role:admin')
    ->name('user_delete');