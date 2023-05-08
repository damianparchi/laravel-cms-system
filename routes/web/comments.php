<?php

use Illuminate\Support\Facades\Route;

Route::resource('admin/comments', \App\Http\Controllers\CommentController::class)->name('index', 'admin.comments');
Route::resource('admin/comments/store', \App\Http\Controllers\CommentController::class)->name('store', 'admin.comments.store');
Route::resource('admin/comments/update', \App\Http\Controllers\CommentController::class)->name('update', 'admin.comments.update');
Route::resource('admin/comments/destroy', \App\Http\Controllers\CommentController::class)->name('destroy', 'admin.comments.destroy');
Route::resource('admin/comments/show', \App\Http\Controllers\CommentController::class)->name('show', 'admin.comments.show');
Route::resource('admin/comments/replies', \App\Http\Controllers\CommentController::class);
