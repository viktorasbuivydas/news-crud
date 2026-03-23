<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\ArticleController as DashboardArticleController;
use Illuminate\Support\Facades\Route;

// Public Articles
Route::get('/', [ArticleController::class, 'index'])->name('articles.index');
Route::get('articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

// Dashboard
Route::middleware('auth')->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::post('articles/{article}/restore', [DashboardArticleController::class, 'restore'])->name('articles.restore');
    Route::delete('articles/{article}/force-delete', [DashboardArticleController::class, 'forceDelete'])->name('articles.force-delete');
    Route::resource('articles', DashboardArticleController::class);
});

// Authentication
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
