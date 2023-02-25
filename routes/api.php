<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\HealthyFoodController;
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


Route::post("/createRecipe",[HealthyFoodController::class,"createRecipe"]);
Route::get("/getRecipie/{id}",[HealthyFoodController::class,"getRecipie"]);
Route::get("/getAllRecipies",[HealthyFoodController::class,"getAllRecipies"]);
Route::post("/updateRecipie",[HealthyFoodController::class,"updateRecipie"]);
Route::delete("/deleteRecipie",[HealthyFoodController::class,"deleteRecipie"]);