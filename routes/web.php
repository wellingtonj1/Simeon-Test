<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
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

// Route group middleware auth
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Posts
    Route::resource('posts', PostController::class);
    Route::get('/my-posts', [PostController::class, 'myPosts'])->name('posts.my-posts');

    // Comments
    Route::get('/posts/{post}/comments', [CommentController::class, 'show'])->name('posts.comments.show');
    Route::post('/posts/{post}/comments', [CommentController::class, 'storeComment'])->name('posts.comments.store');

});

require __DIR__.'/auth.php';

