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

        // One-click demo sign-in for the portfolio (mkado.dev): allow-listed
        // accounts only, see config/demo.php.
        Route::get('demo/{as?}', \App\Http\Controllers\Auth\DemoLoginController::class)
            ->where('as', '[a-z]+')->middleware('throttle:10,1')->name('demo.login');

        Route::get('/', function () {
            return redirect()->route('dashboard.index');
        });
    }
);

// Uptime probe for the portfolio's status board (mkado.dev/status.json) and
// external monitors: a real DB round-trip, nothing about versions/environment.
Route::get('/health', function () {
    try {
        \Illuminate\Support\Facades\DB::select('select 1');
        return response()->json(['status' => 'ok'])->header('Cache-Control', 'no-store');
    } catch (\Throwable $e) {
        return response()->json(['status' => 'down'], 503)->header('Cache-Control', 'no-store');
    }
});
