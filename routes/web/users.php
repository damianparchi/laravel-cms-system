<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LogoutController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/admin', [AdminsController::class, 'index'])->name('admin.index');

Route::middleware(['auth'])->group(function (){
    Route::get('/logout', [LogoutController::class, 'logout'])->name('admin.logout');
    Route::put('/users/{user}/update', [UserController::class, 'update'])->name('user.profile.update');
    Route::delete('/users/destroy/{user}', [UserController::class, 'destroy'])->name('user.destroy');
});

Route::middleware(['role:admin', 'auth'])->group(function () {
    Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::put('/users/{user}/attach', [UserController::class, 'attachRole'])->name('user.role.attach');
    Route::put('/users/{user}/detach', [UserController::class, 'detachRole'])->name('user.role.detach');
});

Route::middleware(['can:view,user'])->group(function () {
    Route::get('/users/{user}/profile', [UserController::class, 'show'])->name('user.profile.show');

});
