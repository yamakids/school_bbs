<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\PostsController;
use  App\Http\Controllers\CommentsController;
use  App\Http\Controllers\ShowController;
use  App\Http\Controllers\FavoriteController;


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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/',  [PostsController::class, 'index'])->name('top');

Route::resource('/posts', PostsController::class, ['only' => ['create', 'store', 'show' , 'edit', 'update', 'destroy']]);

Route::resource('/comments', CommentsController::class, ['only' => ['index','create','store','show','edit']]);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('/shows', ShowController::class, ['only' => ['show']]);

Route::post('/posts/search',  [PostsController::class, 'search'])->name('posts.search');

Route::post('posts/{post}/favorites', [FavoriteController::class,'store'])->name('favorites');

Route::post('posts/{post}/unfavorites', [FavoriteController::class,'destroy'])->name('unfavorites');
