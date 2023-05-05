<?php


use Illuminate\Support\Facades\Route;

Route::get('/logout', [App\Http\Controllers\Auth\LogoutController::class, 'logout'])->name('admin.logout');

Route::put('/users/{user}/update', [\App\Http\Controllers\UserController::class, 'update'])->name('user.profile.update');

Route::delete('/users/destroy/{user}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');


Route::middleware(['role:admin', 'auth'])->group(function () {
    Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');

});

Route::middleware(['can:view,user'])->group(function () {
    Route::get('/users/{user}/profile', [\App\Http\Controllers\UserController::class, 'show'])->name('user.profile.show');

});
