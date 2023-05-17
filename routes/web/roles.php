<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;

Route::middleware(['auth'])->group(function (){
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::delete('/roles/{role}/delete', [RoleController::class, 'delete'])->name('roles.delete');
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/{role}/update', [RoleController::class, 'update'])->name('roles.update');
    Route::put('/roles/{role}/attach', [RoleController::class, 'attachPermission'])->name('role.permission.attach');
    Route::put('/roles/{role}/detach', [RoleController::class, 'detachPermission'])->name('role.permission.detach');
});

