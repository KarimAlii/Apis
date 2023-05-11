<?php

use App\Http\Controllers\Companies\Auth\AuthController;
use App\Http\Controllers\Companies\Profile\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/**
 * Authentication Routes
 */
Route::post('/login',[AuthController::class,'login']);
Route::post('/register',[AuthController::class,'register']);


/**
 * Profile Routes
 */
Route::group(['middleware' => ['auth:sanctum']],function (){
    Route::get('/profile',[ProfileController::class,'index']);
    Route::put('/profile',[ProfileController::class,'update']);
});
