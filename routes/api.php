<?php

use App\Http\Controllers\ArticleController;
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
    Route::get('auth-user', [UserController::class, 'authUser'])->name('admin.auth-user');

    Route::middleware('guest')->group(function() {
        Route::post('login', [UserController::class, 'login'])->name('login');
    });

    Route::middleware('auth')->group(function() {
        Route::post('logout', [UserController::class, 'logout'])->name('logout');

        Route::apiResource('user', UserController::class)->except('show')->middleware('role:super admin');
        Route::apiResource('pass', PassController::class)->middleware('permission:manage site');
        Route::apiResource('article', ArticleController::class)->middleware('permission:edit articles');
    });
});

// role:super admin|admin|writer
// permission:manage site|scan tickets|edit articles