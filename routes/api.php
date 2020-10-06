<?php
declare(strict_types=1);

use App\Http\Controllers\Api\AttributeController;
use App\Http\Controllers\Api\AttributeValueController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ForgotPasswordController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\UploadImageController;
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

Route::middleware(['guest', 'throttle:60,1'])->group(function() {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::resource('/attributes', AttributeController::class)->only(['index', 'show']);
    Route::resource('/attribute-values', AttributeValueController::class)->only(['index', 'show']);
    Route::get('/categories/all-tree', [CategoryController::class, 'getAllTree']);
    Route::get('/categories/types', [CategoryController::class, 'getTypes']);
    Route::resource('/categories', CategoryController::class)->only(['index', 'show']);
    Route::resource('/products', ProductController::class)->only(['index', 'show']);
});

Route::middleware(['auth:api', 'throttle:60,1'])->group(function() {
    Route::resource('/attributes', AttributeController::class)->except(['index', 'show']);
    Route::resource('/attribute-values', AttributeValueController::class)->except(['index', 'show']);
    Route::resource('/categories', CategoryController::class)->except(['index', 'show']);
    Route::resource('/products', ProductController::class)->except(['index', 'show']);
    Route::resource('/upload/images', UploadImageController::class);
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::resource('/projects', ProjectController::class);
});
