<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ShopController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopOwnerProfileController; 

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Shop Owner Profile Routes
Route::middleware(['auth'])->prefix('shop-owner')->name('shop-owner.')->group(function () {
    Route::get('/dashboard', [ShopOwnerProfileController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [ShopOwnerProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ShopOwnerProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ShopOwnerProfileController::class, 'update'])->name('profile.update');
});


Route::group(['prefix' => 'shop', 'middleware' => ['auth', 'role:admin']], function () {
    Route::get('/', [ShopController::class, 'index'])->name('shop.index');
    Route::get('/create', [ShopController::class, 'create'])->name('shop.create');
    Route::post('/', [ShopController::class, 'store'])->name('shop.store');
    Route::get('/{shop}', [ShopController::class, 'show'])->name('shop.show');
    Route::get('/{shop}/edit', [ShopController::class, 'edit'])->name('shop.edit');
    Route::put('/{shop}', [ShopController::class, 'update'])->name('shop.update');
    Route::delete('/{shop}', [ShopController::class, 'destroy'])->name('shop.destroy');
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

Route::get('dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'role:shop-owner'])->name('dashboard');



// changed by me

// Route::middleware(['auth'])->group(function () {
//     Route::resource('product', ProductController::class);
// });

// Order Route 

Route::get('order', [OrderController::class,'index'])->name('order.index');
Route::patch('/order/{order}/reject',[OrderController::class, 'reject'])->name('order.reject');

// Admin routes for product visibility management
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/products/visibility', [App\Http\Controllers\Admin\ProductVisibilityController::class, 'index'])->name('products.visibility');
    Route::post('/products/{product}/toggle-status', [App\Http\Controllers\Admin\ProductVisibilityController::class, 'toggleStatus'])->name('products.toggle-status');
    Route::post('/products/{product}/toggle-featured', [App\Http\Controllers\Admin\ProductVisibilityController::class, 'toggleFeatured'])->name('products.toggle-featured');
}); 
