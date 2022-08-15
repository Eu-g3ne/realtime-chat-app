<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ThreadController;
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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
  Route::get('user', [AuthController::class, 'authenticated']);
  Route::prefix('threads')->group(function () {
    Route::get('/', [ThreadController::class, 'index']);
    Route::prefix('{thread}')->group(function () {
      Route::get('/', [ThreadController::class, 'participants']);
      Route::get('messages', [MessageController::class, 'index']);
    });
  });
  Route::post('logout', [AuthController::class, 'logout']);
});
