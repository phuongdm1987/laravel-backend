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

Route::namespace('Api')->middleware('guest')->group(function() {
    Route::post('/login', 'AuthController@login');
    Route::post('/register', 'AuthController@register');
    Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail');
    Route::resource('/attributes', 'AttributeController')->only(['index', 'show']);
    Route::resource('/attribute-values', 'AttributeValueController')->only(['index', 'show']);
    Route::get('/categories/all-tree', 'CategoryController@getAllTree');
    Route::get('/categories/types', 'CategoryController@getTypes');
    Route::resource('/categories', 'CategoryController')->only(['index', 'show']);
    Route::resource('/products', 'ProductController')->only(['index', 'show']);
});

Route::middleware('auth:api')->namespace('Api')->group(function() {
    Route::resource('/attributes', 'AttributeController')->except(['index', 'show']);
    Route::resource('/attribute-values', 'AttributeValueController')->except(['index', 'show']);
    Route::resource('/categories', 'CategoryController')->except(['index', 'show']);
    Route::resource('/products', 'ProductController')->except(['index', 'show']);
    Route::resource('/upload/images', 'UploadImageController');
    Route::get('/logout', 'AuthController@logout');
    Route::resource('/projects', 'ProjectController');
});
