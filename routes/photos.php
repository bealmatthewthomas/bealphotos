<?php
/**
 * Created by PhpStorm.
 * User: matthewtbeal
 * Date: 2/26/19
 * Time: 5:48 PM
 */

Route::get('/photos', 'PhotosController@index')
    ->name('photos_index');

Route::get('/photo/create', 'PhotosController@create')
    ->middleware('auth','check_role:album')
    ->name('photo_create');

Route::post('/photo/create/{album_id?}', 'PhotosController@store')
    ->middleware('auth','check_role:album')
    ->name('photo_store');

Route::get('/photo/view/{photo_id}', 'PhotosController@view')
    ->name('photo_view');

Route::post('photo/edit', 'PhotosController@edit')
    ->middleware('auth','check_role:album')
    ->name('photo_edit');

Route::post('photo/delete/{photo_id}', 'PhotosController@delete')
    ->middleware('auth','check_role:album')
    ->name('photo_delete');