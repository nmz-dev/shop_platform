<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ShopController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['prefix' => 'shop'], function () {
    Route::post('/create',[ShopController::class, 'store'])->name('shop.store');
    Route::get('/',[ShopController::class,'index'])->name('shop.index');
    Route::put('/update',[ShopController::class,'update'])->name('shop.update');
});

// Routes Related to products
Route::get('/product/',[\App\Http\Controllers\ProductController::class, 'index'])->name('product.index');

// Routes Related to categories
Route::resource('category', \App\Http\Controllers\CategoryController::class);
