<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ShopController;
use App\Http\Controllers\ProductController; 

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
// Route::get('/product/',[\App\Http\Controllers\ProductController::class, 'index'])->name('product.index');

// Routes Related to categories
// Route::resource('category', \App\Http\Controllers\CategoryController::class);

Route::get('/product/test',function(){
    App\Models\Product::first()->update(['colors'=>"red,blue,green"]);
    return redirect()->back();
})->name('product.test');
Route::middleware(['auth'])->group(function () {
    Route::resource('category', \App\Http\Controllers\CategoryController::class);
    Route::resource('product', ProductController::class);
});
// change by me

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');



// changed by me

// Route::middleware(['auth'])->group(function () {
//     Route::resource('product', ProductController::class);
// });

// Order Route 

Route::get('order', [OrderController::class,'index'])->name('order.index');
Route::patch('/order/{order}/reject',[OrderController::class, 'reject'])->name('order.reject'); 
