<?php

use App\Http\Controllers\DirectorioController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/user', [UserController::class,'store']);
Route::post('/login', [UserController::class,'login']);
Route::group(['middleware'=>'auth:api'], function(){
    Route::apiResource('directorios', DirectorioController::class);
    Route::post('logout', [UserController::class, 'logout']);
});

