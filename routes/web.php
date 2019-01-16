<?php
declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);
Route::get('logout', 'Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/set-language/{locale}', function($locale) {
    $locales = config('language', []);

    if (!array_key_exists($locale, $locales)) {
        $locale = array_first(array_keys($locales));
    }

    session(['locale' => $locale]);

    return redirect()->back();
})->name('setLanguage');


Route::resource('/api/project', 'ProjectController');
