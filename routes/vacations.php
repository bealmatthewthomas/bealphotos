<?php
Route::get('vacations', 'VacationsController@index')
    ->name('vacations_index');

Route::get('vacation/view/{vacation_id}', 'VacationsController@view')
    ->name('vacation_view');

Route::get('vacation/create', 'VacationsController@create')
    ->middleware('auth')
    ->name('vacation_create');

Route::post('vacation/store', 'VacationsController@store')
    ->middleware('auth')
    ->name('vacation_store');

Route::post('vacations', 'VacationsController@delete')
    ->middleware('auth')
    ->name('vacation_delete');