<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {
    Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.', 'middleware' =>['auth']], function () {

        Route::get('/index', [DashboardController::class, 'index'])->name('index');
        Route::resource('users', UserController::class)->except('show');

    });
});
