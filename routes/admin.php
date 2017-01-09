<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function() {
    Route::get('/', 'Admin\AdminController@index');
    Route::get('faq', 'Admin\AdminController@faq')->name('faq');
    Route::resource('departments', 'Admin\DepartmentController');
    Route::resource('requests', 'Admin\RequestsController');
    Route::resource('personal', 'Admin\PersonalController');
    Route::resource('news', 'Admin\NewsController');
    Route::resource('pages', 'Admin\PagesController');
});