
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\PostController;

Route::get('/custom-home', [PostController::class, 'index'])->name('custom.home');

Route::group(['middleware' => 'auth'], function () {

    // posts route

    Route::group(['prefix' => 'posts', 'as' => 'posts.'], function () {
        Route::get('/trashed', [PostController::class, 'trashed'])->name('trashed');
        Route::post('/restore/{post}', [PostController::class, 'restore'])->name('restore');
        Route::delete('/force-delete/{post}', [PostController::class, 'forceDelete'])->name('forceDelete');
    });

    Route::resource('posts', PostController::class);
});
