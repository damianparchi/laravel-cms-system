<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;

Route::resource('categories', CategoriesController::class)->names('admin.categories');
Route::get('/categories/search', [CategoriesController::class, 'search']);
