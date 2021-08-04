<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\PostController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\AuthorController;
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

Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/admin/login', [UserController:: class, 'login'])->name('admin-login');
Route::post('admin/post/login', [UserController:: class, 'adminPostLogin'])->name('admin-post-login');
Route::get('admin/logout', [UserController:: class, 'adminLogout'])->name('admin-logout');

Route::name('admin-')->middleware(['admin'])->prefix('admin')->group(function() {
    Route::get('/posts', [PostController:: class, 'posts'])->name('posts');
    Route::get('/add-post', [PostController:: class, 'addPost'])->name('add-post');
    Route::post('/post-add-post', [PostController:: class, 'postAddPost'])->name('post-add-post');
    Route::get('/edit-post/{id}', [PostController:: class, 'editPost'])->name('edit-post');
    Route::post('/post-edit-post', [PostController:: class, 'postUpdatePost'])->name('post-edit-post');
    Route::get('/post/delete/{id}', [PostController:: class, 'deletePost'])->name('delete-post');

    Route::get('/authors', [UserController:: class, 'authors'])->name('authors');
    Route::get('/add/author', [UserController:: class, 'addAuthor'])->name('add-author');
    Route::post('/post/add/author', [UserController:: class, 'postAddAuthor'])->name('post-add-author');
    Route::get('/edit/author/{id}', [UserController:: class, 'editAuthor'])->name('edit-author');
    Route::post('/update/author', [UserController:: class, 'updateAuthor'])->name('update-author');
    Route::get('/author/delete/{id}', [UserController:: class, 'deleteAuthor'])->name('delete-author');

    Route::get('/users', [UserController:: class, 'users'])->name('users');
    Route::get('/add/user', [UserController:: class, 'addUser'])->name('add-user');
    Route::post('/post/add/user', [UserController:: class, 'postAddUser'])->name('post-add-user');
    Route::get('/edit/user/{id}', [UserController:: class, 'editUser'])->name('edit-user');
    Route::post('/update/user', [UserController:: class, 'updateUser'])->name('update-user');
    Route::get('/user/delete/{id}', [UserController:: class, 'deleteUser'])->name('delete-user');
});

Route::get('/author/login', [AuthorController:: class, 'login'])->name('author-login');
Route::post('author/post/login', [AuthorController:: class, 'authorPostLogin'])->name('author-post-login');
Route::get('author/logout', [AuthorController:: class, 'authorLogout'])->name('author-logout');
Route::get('author/register', [AuthorController:: class, 'register'])->name('author-register');
Route::post('author/post/register', [AuthorController:: class, 'postRegister'])->name('author-post-register');

Route::name('author-')->middleware(['author'])->prefix('author')->group(function() {
    Route::get('/dashboard', [AuthorController:: class, 'dashboard'])->name('dashboard');

});