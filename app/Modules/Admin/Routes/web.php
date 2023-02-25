<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin'], static function () {
    Route::get('/', 'AdminController@index')->name('admin.index');
});
