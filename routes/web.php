<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\EditorController;
use App\Http\Controllers\Admin\ImageController;

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

Route::get('/', [NewsController::class, 'index'])->name('home');
Route::get('/home', [NewsController::class, 'index']);
Route::get('/news/{article}', [NewsController::class, 'show'])->name('news.show');

Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [LoginController::class, 'show'])->name('login');
    Route::post('/admin/login', [LoginController::class, 'store']);
});

Route::middleware('auth')->prefix('admin')->group(function () {
    // Route::get('/', [TODO, 'show']);
    
    Route::post('/logout', [LoginController::class, 'delete'])->name('logout');

    Route::resource('editors', EditorController::class)->except(['show']);

    Route::get('articles/my', [ArticleController::class, 'indexMy'])->name('articles.my');
    Route::resource('articles', ArticleController::class)->except('show');

    Route::post('images', [ImageController::class, 'store'])->name('images.store');
});
