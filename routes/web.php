<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\PostController;
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

Route::get('/posts', [PostController:: class, 'posts'])->name('posts');
Route::get('/add-post', [PostController:: class, 'addPost'])->name('add-post');
Route::post('/post-add-post', [PostController:: class, 'postAddPost'])->name('post-add-post');
Route::get('/edit-post/{id}', [PostController:: class, 'editPost'])->name('edit-post');
Route::post('/post-edit-post', [PostController:: class, 'postUpdatePost'])->name('post-edit-post');