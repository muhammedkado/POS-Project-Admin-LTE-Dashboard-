<?php

use App\Http\Controllers\dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ClientController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\ProductController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {
    Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.', 'middleware' =>['auth']], function () {

        Route::get('/index', [DashboardController::class, 'index'])->name('index');

        //category routes
        Route::resource('categories', CategoryController::class)->except('show');
        //products routes
        Route::resource('products', ProductController::class)->except('show');
        //clients routes
        Route::resource('clients', ClientController::class)->except('show');
        //users routes
        Route::resource('users', UserController::class)->except('show');

    });
});
