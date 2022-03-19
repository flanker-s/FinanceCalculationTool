<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\Templates\TemplateController;
use App\Http\Controllers\Api\v1\Templates\CategoryController;
use App\Http\Controllers\Api\v1\Templates\TypeCategoryController;
use App\Http\Controllers\Api\v1\Templates\TypeController;
use \App\Http\Controllers\Api\v1\UserController;
use \App\Http\Controllers\Api\AuthController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group([
    'prefix' => 'v1',
    'middleware' => ['auth:sanctum']
], function () {
    Route::apiResources([
        '/templates/types.categories' => TypeCategoryController::class,
        '/templates/categories' => CategoryController::class,
        '/templates/types' => TypeController::class,
        '/templates' => TemplateController::class,
    ]);
});

