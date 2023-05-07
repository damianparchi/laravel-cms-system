<?php

use Illuminate\Support\Facades\Route;

Route::get('/permissions', [\App\Http\Controllers\PermissionController::class, 'index'])->name('permissions.index');
Route::post('/permissions/store', [\App\Http\Controllers\PermissionController::class, 'store'])->name('permissions.store');
Route::delete('/permissions/{permission}/delete', [\App\Http\Controllers\PermissionController::class, 'delete'])->name('permissions.delete');
Route::get('/permissions/{permission}/edit', [\App\Http\Controllers\PermissionController::class, 'edit'])->name('permissions.edit');
