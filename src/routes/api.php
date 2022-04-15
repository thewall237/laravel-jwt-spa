<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;

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

// 会員登録
Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::post('login', [App\Http\Controllers\Api\AuthController::class, 'login']);
Route::get('refresh', [App\Http\Controllers\Api\AuthController::class, 'refresh']);
Route::group(['middleware' => ['jwt.auth']], function () {
    Route::post('logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);
    Route::get('me', [App\Http\Controllers\Api\AuthController::class, 'me']);
});
