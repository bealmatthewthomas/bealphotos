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
    ->middleware('auth')
    ->name('photo_create');

Route::post('/photo/create', 'PhotosController@store')
    ->name('photo_store');
