<?php

use Illuminate\Support\Facades\Route;

Route::get('dashboard', function() {
    if (1 == Auth::user()->id || Auth::user()->department_id) {
        return redirect('/admin');
    }

    if (null == Auth::user()->department_id) {
        return redirect('/dashboard/requests');
    }
});

Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.', 'middleware' => 'auth'], function() {
    Route::resource('requests', 'DashboardController');
});