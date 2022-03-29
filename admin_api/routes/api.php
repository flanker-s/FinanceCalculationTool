<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\Templates\TemplateController;
use App\Http\Controllers\Api\v1\Templates\CategoryController;
use App\Http\Controllers\Api\v1\Templates\OperationCategoryController;
use App\Http\Controllers\Api\v1\Templates\OperationController;
use \App\Http\Controllers\Api\AuthenticationController;

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

Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);

Route::group([
    'prefix' => 'v1',
    'middleware' => ['auth:sanctum']
], function () {
    Route::apiResources([
        '/templates/operations.categories' => OperationCategoryController::class,
        '/templates/categories' => CategoryController::class,
        '/templates/operations' => OperationController::class,
        '/templates' => TemplateController::class,
    ]);
});

