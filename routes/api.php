<?php

use App\Http\Controllers\PassController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('admin')->group(function() {
    Route::get('user', fn() => response()->json(['user' => auth()->user()]))->name('admin.user');

    Route::middleware('guest')->group(function() {
        Route::post('login', [UserController::class, 'login'])->name('login');
    });

    Route::middleware('auth')->group(function() {
        Route::post('logout', [UserController::class, 'logout'])->name('logout');
        Route::apiResource('pass', PassController::class);
    });
});