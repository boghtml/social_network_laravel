<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FollowerController;

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

// Перенаправлення на домашню сторінку, якщо користувач авторизований
Route::middleware(['auth'])->group(function () {
     Route::get('/', [HomeController::class, 'index'])->name('home');
});

require __DIR__.'/auth.php';  // Це підключає маршрути для реєстрації, авторизації тощо.


Route::middleware(['auth'])->group(function () {
    Route::get('/profile/{username}', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/{username}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{username}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/{username}', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/like/toggle/{post}', [PostController::class, 'toggleLike'])->name('like.toggle');
Route::post('/save/toggle/{post}', [PostController::class, 'toggleSave'])->name('save.toggle');

Route::post('/follow/{username}', [FollowerController::class, 'toggleFollow'])->name('follow.toggle');
