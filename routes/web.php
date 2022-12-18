<?php

use App\Http\Controllers\Front\PostController;
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

Route::get('/', [PostController::class , 'index'] );
Route::get('blog/posts/{post}', [PostController::class , 'show'])->name('blog.posts.show');

Auth::routes();



// in file routes/dashboard
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

