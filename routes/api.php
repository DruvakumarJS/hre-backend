<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\EmployeeController;
use App\Http\Controllers\api\MaterialController;

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

Route::get('/getusers',[UserController::class , 'index']);
Route::post('/search-user',[UserController::class , 'search']);
Route::post('/validate-login',[UserController::class,'validate_login']);
Route::post('/get-material-details',[MaterialController::class,'material_data']);
