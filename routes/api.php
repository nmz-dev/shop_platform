<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Auth routes
Route::post('/login', [App\Http\Controllers\Api\LoginController::class, 'login']);
Route::post('/register', [\App\Http\Controllers\Api\LoginController::class, 'register']);
Route::post('/logout', [\App\Http\Controllers\Api\LoginController::class, 'logout'])->middleware('auth:sanctum');
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/user', [\App\Http\Controllers\Api\LoginController::class,'getUser']);
    Route::get('/products', [\App\Http\Controllers\Api\ProductController::class,'index']);
});
