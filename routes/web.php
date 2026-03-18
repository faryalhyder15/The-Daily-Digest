<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;


// Public Routes
Route::get('/', [PostController::class, 'index']);
Route::get('/posts/create', [PostController::class, 'create'])->middleware('auth');
Route::post('/posts', [PostController::class, 'store'])->middleware('auth');
Route::get('/posts/{post}', [PostController::class, 'show']);
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->middleware('auth');
Route::put('/posts/{post}', [PostController::class, 'update'])->middleware('auth');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->middleware('auth');
Route::post('/comments', [CommentController::class, 'store'])->middleware('auth');

// Page Routes
Route::get('/about', [PageController::class, 'about']);
Route::get('/contact', [PageController::class, 'contact']);
Route::post('/contact', [PageController::class, 'sendContact']);

// Profile Routes
Route::get('/profile', [ProfileController::class, 'index'])->middleware('auth');
Route::put('/profile', [ProfileController::class, 'update'])->middleware('auth');

//Admin
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
Route::get('/', [AdminController::class, 'index']);
Route::get('/posts', [AdminController::class, 'posts']);
Route::get('/users', [AdminController::class, 'users']);
Route::delete('/posts/{post}', [AdminController::class, 'deletePost'])->name('admin.posts.delete');
Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
});

Auth::routes();