<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ThreadController;
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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
  Route::get('user', [AuthController::class, 'authenticated']);
  Route::apiResource('threads', ThreadController::class)->except(['update', 'destroy', 'show']);
  Route::prefix('threads')->group(function () {
    Route::prefix('{thread}')->group(function () {
      Route::get('/', [ThreadController::class, 'participants']);
      Route::get('messages', [MessageController::class, 'index']);
    });
  });
  Route::get('users', [UserController::class, 'index']);
  Route::post('logout', [AuthController::class, 'logout']);
});
