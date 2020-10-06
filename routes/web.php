<?php
declare(strict_types=1);

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductUserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', static function () {
    return view('welcome');
});

Route::get('logout', [LoginController::class, 'logout']);

Route::middleware(['auth', 'verified'])->group(static function() {
    Route::get('/home', [HomeController::class, 'index'])
        ->name('home');

    Route::get('/categories/{category}', [CategoryController::class, 'index'])
        ->name('category.index');

    Route::resource('product-users', ProductUserController::class);
    Route::resource('products', ProductController::class);

    Route::post(
        '/products/attributes/categories',
        [
            \App\Http\Controllers\Admin\ProductController::class,
            'getAttributesByCategoryId'
        ]
    )
        ->name('products.attributes.categories');
});

Route::get('/set-language/{locale}', [LanguageController::class, 'update'])
    ->name('setLanguage');

Auth::routes(['verify' => true]);

Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::group(['prefix' => 'admin'], static function () {
    Voyager::routes();
});
