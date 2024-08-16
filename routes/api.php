<?php

use App\Http\Controllers\Api\KomikController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\UserController;
use App\Http\Middleware\EnsureAuthenticated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// login
Route::post('/login', [LoginController::class, 'login']);

// Route::middleware(['ensure.authenticated'])->group(function () {
Route::middleware([EnsureAuthenticated::class])->group(function () {
    // Komik
    Route::get('komik', [KomikController::class, 'index']);
    Route::get('komik/{id}', [KomikController::class, 'show']);
    Route::post('komik', [KomikController::class, 'store']);
    Route::put('komik/{id}', [KomikController::class, 'update']);
    Route::delete('komik/{id}', [KomikController::class, 'destroy']);

    // User
    Route::get('user', [UserController::class, 'index']);
    Route::get('user/{id}', [UserController::class, 'show']);
    Route::post('user', [UserController::class, 'store']);
    Route::put('user/{id}', [UserController::class, 'update']);
    Route::delete('user/{id}', [UserController::class, 'destroy']);
});
