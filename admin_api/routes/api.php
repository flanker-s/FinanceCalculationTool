<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\Templates\TemplateController;
use App\Http\Controllers\Api\v1\Templates\CategoryController;
use App\Http\Controllers\Api\v1\Templates\TypeCategoryController;
use App\Http\Controllers\Api\v1\Templates\TypeController;

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

Route::apiResources([
    'v1/templates/categories' => CategoryController::class,
    'v1/templates/types.categories' => TypeCategoryController::class,
    'v1/templates/types' => TypeController::class,
    'v1/templates' => TemplateController::class,
]);