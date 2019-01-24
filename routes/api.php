<?php
declare(strict_types=1);

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('Api')->group(function() {
    Route::post('/login', 'AuthController@login');
});

Route::middleware('auth:api')->namespace('Api')->group(function() {
    Route::get('/logout', 'AuthController@logout');
    Route::get('/products', 'ProductController@index')->name('api.products.index');
});
