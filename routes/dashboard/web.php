<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
    Route::get('/check', function () {
        return 'This is dashboard';
    });
});
