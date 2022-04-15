<?php

use App\Http\Controllers\Api\V1\AbilityController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Defaults\TemplateController;
use App\Http\Controllers\Api\V1\Defaults\CategoryController;
use App\Http\Controllers\Api\V1\Defaults\OperationController;
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

    Route::group(['prefix' => 'users', 'middleware' => 'ability:manage-users'], function (){
        Route::get('/{id}', [UserController::class, 'show']);
        Route::get('/', [UserController::class, 'index'])->name('users');
        Route::post('/', [UserController::class, 'store']);
        Route::put('/{id}', [UserController::class, 'update']);
        Route::delete('/{id}', [UserController::class, 'destroy']);
    });

    Route::group(['prefix' => 'abilities', 'middleware' => 'ability:manage-users'], function (){
        Route::get('/{id}', [AbilityController::class, 'show']);
        Route::get('/', [AbilityController::class, 'index'])->name('abilities');
    });

    Route::group([
        'prefix' => 'defaults'
    ], function (){
        Route::group(['prefix' => 'operations'], function (){
            Route::get('/{id}', [OperationController::class, 'show']);
            Route::get('/', [OperationController::class, 'index'])->name('operations');
        });
        Route::group(['prefix' => 'categories'], function (){
            Route::get('/{id}', [CategoryController::class, 'show']);
            Route::get('/', [CategoryController::class, 'index'])->name('categories');
            Route::post('/', [CategoryController::class, 'store'])->middleware(['ability:manage-categories']);
            Route::put('/{id}', [CategoryController::class, 'update'])->middleware(['ability:manage-categories']);
            Route::delete('/{id}', [CategoryController::class, 'destroy'])->middleware(['ability:manage-categories']);
        });
        Route::group(['prefix' => 'templates'], function (){
            Route::get('/{id}', [TemplateController::class, 'show']);
            Route::get('/', [TemplateController::class, 'index'])->name('templates');
            Route::post('/', [TemplateController::class, 'store'])->middleware(['ability:manage-templates']);
            Route::put('/{id}', [TemplateController::class, 'update'])->middleware(['ability:manage-templates']);
            Route::delete('/{id}', [TemplateController::class, 'destroy'])->middleware(['ability:manage-templates']);
        });
    });
});

