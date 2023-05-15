<?php

use Illuminate\Support\Facades\Route;

Route::get('/categories', [\App\Http\Controllers\CategoriesController::class, 'index'])->name('admin.categories');
Route::delete('/categories/delete/{category}', [\App\Http\Controllers\CategoriesController::class, 'delete'])->name('admin.categories.delete');
Route::post('/categories/create', [\App\Http\Controllers\CategoriesController::class, 'create'])->name('admin.categories.create');
Route::get('/categories/edit/{category}', [\App\Http\Controllers\CategoriesController::class, 'edit'])->name('admin.categories.edit');
Route::put('/categories/update/{category}', [\App\Http\Controllers\CategoriesController::class, 'update'])->name('admin.categories.update');
