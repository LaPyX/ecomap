<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'AppController@index');
Route::get('/requests/ajax', 'ResourceController@ajax');
Route::resource('requests', 'ResourceController');

Route::post('departments', 'ResourceController@getDepartmentInfo');

Auth::routes();

//Route::get('/home', 'HomeController@index');

include 'admin.php';