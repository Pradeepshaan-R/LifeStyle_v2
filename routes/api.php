<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Backend\AuthorController;
use App\Http\Controllers\Backend\BookController;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('serverStatus', [AuthController::class, 'serverStatus']);
Route::post('forgotPasswordEmail', [AuthController::class, 'forgotPasswordEmail']);
Route::post('forgotPassword', [AuthController::class, 'forgotPassword']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('profile', [AuthController::class, 'getProfile']);
    Route::post('profile', [AuthController::class, 'updateProfile']);
    Route::get('dashboard', [AuthController::class, 'dashboard']);

    Route::resource('author', AuthorController::class);
    Route::resource('book', BookController::class);
});
