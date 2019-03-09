<?php
/**
 * Created by PhpStorm.
 * User: matthewtbeal
 * Date: 3/6/19
 * Time: 11:32 PM
 */

Route::get('admin', 'AdminController@view')
    ->middleware('auth','check_role:admin')
    ->name('view_admin_portal');