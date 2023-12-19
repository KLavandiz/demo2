<?php

use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Middleware\AuthenticateOnceWithBasicAuth;
use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;
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

Route::group(['prefix' => 'v1/product-service', 'namespace' => 'App\Http\Controllers\Api\V1'], function () {

    Route::get('/categories', [CategoryController::class, 'index'])->middleware(AuthenticateWithBasicAuth::class);
    Route::post('/category/create', [CategoryController::class, 'create'])->middleware(AuthenticateWithBasicAuth::class);
    Route::get('/category/show', [CategoryController::class, 'show'])->middleware(AuthenticateWithBasicAuth::class);
    Route::post('/category/destroy', [CategoryController::class, 'destroy'])->middleware(AuthenticateWithBasicAuth::class);
    Route::post('/category/update', [CategoryController::class, 'update'])->middleware(AuthenticateWithBasicAuth::class);

    Route::get('/products', [ProductController::class, 'index'])->middleware(AuthenticateWithBasicAuth::class);
    Route::get('/products/category/show', [ProductController::class, 'category'])->middleware(AuthenticateWithBasicAuth::class);
    Route::post('/product/create', [ProductController::class, 'create'])->middleware(AuthenticateWithBasicAuth::class);
    Route::get('/product/show', [ProductController::class, 'show'])->middleware(AuthenticateWithBasicAuth::class);
    Route::post('/product/destroy', [ProductController::class, 'destroy'])->middleware(AuthenticateWithBasicAuth::class);
    Route::post('/product/update', [ProductController::class, 'update'])->middleware(AuthenticateWithBasicAuth::class);

    Route::get('/product/filterQuery', [ProductController::class, 'filterQuery'])->middleware(AuthenticateWithBasicAuth::class);

});

