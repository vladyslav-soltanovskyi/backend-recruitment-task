<?php

use App\Controllers\SiteController;
use App\Controllers\UserController;
use System\Router\Route;

// web routes
Route::get('/', [SiteController::class, 'users']);
Route::get('/create-user', [SiteController::class, 'createUser']);

// api routes
Route::get('/api/users', [UserController::class, 'getAll']);
Route::post('/api/users', [UserController::class, 'create']);
Route::delete('/api/users/{id}', [UserController::class, 'delete']);