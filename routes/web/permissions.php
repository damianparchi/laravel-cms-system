<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PermissionController;

Route::middleware(['auth'])->group(function (){
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
    Route::post('/permissions/store', [PermissionController::class, 'store'])->name('permissions.store');
    Route::delete('/permissions/{permission}/delete', [PermissionController::class, 'delete'])->name('permissions.delete');
    Route::get('/permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::put('/permissions/{permission}/update', [PermissionController::class, 'update'])->name('permissions.update');
});

