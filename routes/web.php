<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/articles/create', [App\Http\Controllers\ArticleController::class, 'create'])->name('articles.create');
Route::post('/articles', [App\Http\Controllers\ArticleController::class, 'store'])->name('articles.store');
Route::get('/articles/{slug}', [App\Http\Controllers\ArticleController::class, 'show'])->name('articles.show');
