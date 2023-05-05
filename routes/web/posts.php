<?php

use Illuminate\Support\Facades\Route;


Route::get('/post/{post}', [App\Http\Controllers\PostController::class, 'show'])->name('post');
Route::get('/posts', [App\Http\Controllers\PostController::class, 'index'])->name('post.index');
Route::get('/posts/create', [App\Http\Controllers\PostController::class, 'create'])->name('post.create');
Route::post('/posts', [App\Http\Controllers\PostController::class, 'store'])->name('post.store');
Route::delete('/posts/destroy/{post}', [App\Http\Controllers\PostController::class, 'destroy'])->name('post.destroy');
Route::get('/posts/edit/{post}', [App\Http\Controllers\PostController::class, 'edit'])->name('post.edit');
Route::put('/posts/update/{post}', [App\Http\Controllers\PostController::class, 'update'])->name('post.update');

