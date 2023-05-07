<?php

use Illuminate\Support\Facades\Route;

Route::resource('admin/comments', \App\Http\Controllers\CommentController::class)->name('index', 'admin.comments');
Route::resource('admin/comments/replies', \App\Http\Controllers\CommentController::class);
