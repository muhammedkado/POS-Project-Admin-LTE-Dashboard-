<?php

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// The auth routes live inside the locale group as well, otherwise the language
// switcher links to /ar/login and gets a 404 — and a session that expires while
// browsing in Arabic drops the visitor onto the English login page.
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    ],
    function () {
        Auth::routes(['register' => false, 'reset' => false]);

        Route::get('/', function () {
            return redirect()->route('dashboard.index');
        });
    }
);
