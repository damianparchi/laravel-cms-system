<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentRepliesController;
use App\Http\Controllers\CommentController;

Route::resource('/comments', CommentController::class)->name('index', 'admin.comments');

Route::middleware(['auth'])->group(function () {
    Route::post('/comments/reply', [CommentRepliesController::class, 'createReply'])->name('admin.comments.reply');
    Route::get('/comments/reply/show/{id}', [CommentRepliesController::class, 'show'])->name('reply.show');
    Route::get('/comments/reply/destroy/{id}', [CommentRepliesController::class, 'destroy'])->name('reply.destroy');
    Route::put('/comments/reply/update/{id}', [CommentRepliesController::class, 'update'])->name('reply.update');
    Route::resource('/comments/store', CommentController::class)->name('store', 'admin.comments.store');
    Route::resource('/comments/update', CommentController::class)->name('update', 'admin.comments.update');
    Route::resource('/comments/destroy', CommentController::class)->name('destroy', 'admin.comments.destroy');
});
