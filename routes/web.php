<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/shop/create',[\App\Http\Controllers\ShopController::class, 'store'])->name('shop.store');
Route::get('/shop/',[\App\Http\Controllers\ShopController::class,'index'])->name('shop.index');
Route::put('/shop/update',[\App\Http\Controllers\ShopController::class,'update'])->name('shop.update');
