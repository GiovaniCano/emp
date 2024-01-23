<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'home')->name('home');

Route::view('admin/{any}', 'vue')->where('any', '.*')->name('vue');

Route::get('404', fn() => abort(404))->name('404');
Route::fallback(fn() => to_route('404'));