<?php

use Illuminate\Support\Facades\Route;

Route::resource('users', \App\Http\Controllers\UserController::class);
Route::get('users/search-by', [\App\Http\Controllers\UserController::class, 'searchBy']);
