<?php
/**
 * Created by PhpStorm.
 * User: matthewtbeal
 * Date: 2/26/19
 * Time: 5:48 PM
 */

Route::get('/albums', 'AlbumsController@index')
    ->name('albums_index');

Route::get('/album/create', 'AlbumsController@create')
    ->middleware('auth')
    ->name('album_create');

Route::post('/album/create', 'AlbumsController@store')
    ->name('album_store');

Route::get('/album/view/{album_id}', 'AlbumsController@view')
    ->name('album_view');
/*
Route::post('album/edit', 'AlbumsController@edit')
    ->middleware('auth')
    ->name('album_edit');

Route::post('album/delete/{album_id}', 'AlbumsController@delete')
    ->middleware('auth')
    ->name('album_delete');*/