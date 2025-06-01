<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoryApiController;
use App\Http\Controllers\API\CustomerApiController;
use App\Http\Controllers\API\ProductApiController;
use App\Http\Controllers\API\ProfileApiController;
use App\Http\Controllers\API\TransactionApiController;

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


Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Category API
    Route::resource('categories', CategoryApiController::class);

    // Customer API
    Route::resource('customers', CustomerApiController::class);

    // Product API
    Route::resource('products', ProductApiController::class);

    // Profile
    Route::resource('profile', ProfileApiController::class);

    // Transaction
    Route::resource('transactions', TransactionApiController::class);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

