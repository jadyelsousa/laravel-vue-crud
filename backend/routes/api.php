<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
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


Route::prefix('v1')->group(function () {
    Route::prefix('products')->group(function () {
        Route::get('', [ProductController::class, 'index']);
        Route::get('{id}', [ProductController::class, 'show']);
        Route::post('store', [ProductController::class, 'store']);
        Route::post('{id}', [ProductController::class, 'update']);
        Route::delete('{id}', [ProductController::class, 'destroy']);
    });

    Route::prefix('brands')->group(function () {
        Route::get('', [BrandController::class, 'index']);
        Route::get('{id}', [BrandController::class, 'show']);
        Route::post('store', [BrandController::class, 'store']);
        Route::post('{id}', [BrandController::class, 'update']);
        Route::delete('{id}', [BrandController::class, 'destroy']);
    });
});

Route::get('welcome', function (Request $request) {
    return response()->json(["message" => "hello world"], 200);
});