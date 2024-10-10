<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Middleware\AdminMiddleware; 
use App\Http\Controllers\Admin\ProductControllerAdmin;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/check-db', function () {
    try {
        DB::connection()->getPdo();
        return "Database connection is successful!";
    } catch (\Exception $e) {
        return "Could not connect to the database. Please check your configuration. Error: " . $e->getMessage();
    }
});


require __DIR__.'/auth.php';



Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile/{username}', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/{username}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{username}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/{username}', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/follow/{username}', [FollowerController::class, 'toggleFollow'])->name('follow.toggle');

});

Route::post('/like/toggle/{post}', [PostController::class, 'toggleLike'])->name('like.toggle');
Route::post('/save/toggle/{post}', [PostController::class, 'toggleSave'])->name('save.toggle');

Route::post('/follow/{username}', [FollowerController::class, 'toggleFollow'])->name('follow.toggle');


Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');


Route::get('/store', [StoreController::class, 'home'])->name('store.home');
Route::get('/store/about', [StoreController::class, 'about'])->name('store.about');
Route::get('/store/contact', [StoreController::class, 'contact'])->name('store.contact');
Route::get('/store/privacy', [StoreController::class, 'privacy'])->name('store.privacy');



Route::get('/profile/{username}', [ProfileController::class, 'show'])->name('profile.show');

Route::get('/orders', [OrderController::class, 'index'])->name('orders.index')->middleware('auth');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/orders', [App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/create', [App\Http\Controllers\OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [App\Http\Controllers\OrderController::class, 'store'])->name('orders.store');
   
    Route::get('/orders/confirmation', [OrderController::class, 'confirmation'])->name('orders.confirmation');

    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show')->where('order', '[0-9]+');
});


Route::prefix('admin')
    ->middleware(['auth', AdminMiddleware::class])
    ->name('admin.')
    ->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::resource('orders', App\Http\Controllers\Admin\OrderController::class);
        Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);
        Route::resource('products', App\Http\Controllers\Admin\ProductControllerAdmin::class);
    });