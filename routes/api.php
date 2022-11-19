<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\PostController;
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

Route::get('/users/waiting', [UserController::class, 'waiting']);
Route::apiResource('/users', UserController::class)->except('update');;
Route::post('/users/{userId}', [UserController::class, 'update']);
Route::patch('/users/active/{userId}', [UserController::class, 'active']);

Route::apiResource('/majors', MajorController::class);
Route::apiResource('/categories', CategoryController::class);
Route::apiResource('/posts', PostController::class);

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
