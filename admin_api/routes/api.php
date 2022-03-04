<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Transactions\TemplateController;
use App\Http\Controllers\Api\Transactions\CategoryController;
use App\Http\Controllers\Api\Transactions\Categories\IncomeController;
use App\Http\Controllers\Api\Transactions\Categories\ExpenseController;

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
    'transactions/categories/incomes' => IncomeController::class,
    'transactions/categories/expenses' => ExpenseController::class,
    'transactions/templates' => TemplateController::class,
    'transactions/categories' => CategoryController::class,
]);