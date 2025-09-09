<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Frontend\ArticleController;
use App\Http\Controllers\GoogleLoginController;
use Illuminate\Support\Facades\Route;

// Frontend Routes (for Reader role)
Route::get('/', [ArticleController::class, 'index'])->name('home');
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{article:slug}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/categories/{category:slug}', [ArticleController::class, 'byCategory'])->name('articles.category');
Route::get('/tags/{tag:slug}', [ArticleController::class, 'byTag'])->name('articles.tag');

// Authenticated Frontend Routes
Route::middleware('auth')->group(function () {
    Route::post('/articles/{article}/comments', [ArticleController::class, 'storeComment'])->name('articles.comments.store');
    Route::post('/articles/{article}/like', [ArticleController::class, 'toggleLike'])->name('articles.like');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/auth/google/redirect', [GoogleLoginController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleLoginController::class, 'callback'])->name('google.callback');


require __DIR__.'/auth.php';
