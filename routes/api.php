<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FinancialController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SlideController;
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
Route::apiResource('/users', UserController::class)->except('update');
Route::post('/users/{userId}', [UserController::class, 'update']);
Route::patch('/users/active/{userId}', [UserController::class, 'active']);

Route::apiResource('/majors', MajorController::class);
Route::apiResource('/categories', CategoryController::class);
Route::get('/posts/waiting', [PostController::class, 'waiting']);
Route::patch('/posts/active/{postId}', [PostController::class, 'active']);
Route::apiResource('/posts', PostController::class)->except('update');
Route::post('/posts/{postId}', [PostController::class, 'update']);
Route::apiResource('/slides', SlideController::class)->except(['update', 'show']);

Route::apiResource('/departments', DepartmentController::class);
Route::apiResource('/financials', FinancialController::class)->except(['show', 'destroy']);

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
