<?php

use Illuminate\Support\Facades\Route;

Route::resource('/comments', \App\Http\Controllers\CommentController::class)->name('index', 'admin.comments');
Route::resource('/comments/store', \App\Http\Controllers\CommentController::class)->name('store', 'admin.comments.store');
Route::resource('/comments/update', \App\Http\Controllers\CommentController::class)->name('update', 'admin.comments.update');
Route::resource('/comments/destroy', \App\Http\Controllers\CommentController::class)->name('destroy', 'admin.comments.destroy');


Route::middleware(['auth'])->group(function () {
    Route::post('/comments/reply', [\App\Http\Controllers\CommentRepliesController::class, 'createReply'])->name('admin.comments.reply');
    Route::get('/comments/reply/show/{id}', [\App\Http\Controllers\CommentRepliesController::class, 'show'])->name('reply.show');
    Route::get('/comments/reply/destroy/{id}', [\App\Http\Controllers\CommentRepliesController::class, 'destroy'])->name('reply.destroy');
    Route::put('/comments/reply/update/{id}', [\App\Http\Controllers\CommentRepliesController::class, 'update'])->name('reply.update');
});
