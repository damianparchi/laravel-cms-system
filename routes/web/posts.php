<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/blog/post/{slug}', [PostController::class, 'show'])->name('post');

Route::middleware(['auth'])->group(function (){
    Route::get('/posts', [PostController::class, 'index'])->name('post.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/posts', [PostController::class, 'store'])->name('post.store');
    Route::delete('/posts/destroy/{post}', [PostController::class, 'destroy'])->name('post.destroy');
    Route::get('/posts/edit/{post}', [PostController::class, 'edit'])->name('post.edit');
    Route::put('/posts/update/{post}', [PostController::class, 'update'])->name('post.update');
});



