<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\RecipeController;
use Illuminate\Http\Request;
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
//Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/lists', [ListController::class, 'index']);
Route::get('/lists{id}', [ListController::class, 'show']);
Route::get('/lists/search/{title}', [ListController::class, 'search']);



//Protected routes

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/lists', [ListController::class, 'store']);
    Route::put('/lists/{id}', [ListController::class, 'update']);
    Route::delete('/lists/{id}', [ListController::class, 'destroy']);
    Route::get('/lists', [ListController::class, 'index']);
    Route::get('/lists{id}', [ListController::class, 'show']);
    Route::get('/lists/search/{title}', [ListController::class, 'search']);

    Route::post('lists/recipe/{id}',[RecipeController::class, 'store']);
    Route::delete('lists/recipe/{id}', [RecipeController::class, 'destroy']);
    Route::get('/lists/recipe/search/{recipe_name}', [RecipeController::class, 'search']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
