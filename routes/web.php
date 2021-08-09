<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\PostController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ViewerController;
use App\Http\Controllers\admin\DashboardController;
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

Route::get('/react', function () {
    return view('react');
});
Route::get('/admin/login', [UserController:: class, 'login'])->name('admin-login');
Route::post('admin/post/login', [UserController:: class, 'adminPostLogin'])->name('admin-post-login');
Route::get('admin/logout', [UserController:: class, 'adminLogout'])->name('admin-logout');

Route::name('admin-')->middleware(['admin'])->prefix('admin')->group(function() {
    Route::get('/posts', [PostController:: class, 'posts'])->name('posts');
    Route::get('/add-post', [PostController:: class, 'addPost'])->name('add-post');
    Route::post('/post-add-post', [PostController:: class, 'postAddPost'])->name('post-add-post');
    Route::get('/view-post/{id}', [PostController:: class, 'viewPost'])->name('view-post');
    Route::get('/edit-post/{id}', [PostController:: class, 'editPost'])->name('edit-post');
    Route::post('/post-edit-post', [PostController:: class, 'postUpdatePost'])->name('post-edit-post');
    Route::get('/post/delete/{id}', [PostController:: class, 'deletePost'])->name('delete-post');
    Route::get('comment/{id}', [PostController:: class, 'postComment'])->name('comment');
    Route::get('unlike/{id}', [PostController:: class, 'unlike'])->name('unlike');
    Route::get('like/{id}', [PostController:: class, 'like'])->name('like');

    Route::get('/authors', [UserController:: class, 'authors'])->name('authors');
    Route::get('/add/author', [UserController:: class, 'addAuthor'])->name('add-author');
    Route::post('/post/add/author', [UserController:: class, 'postAddAuthor'])->name('post-add-author');
    Route::get('/edit/author/{id}', [UserController:: class, 'editAuthor'])->name('edit-author');
    Route::post('/update/author', [UserController:: class, 'updateAuthor'])->name('update-author');
    Route::get('/author/delete/{id}', [UserController:: class, 'deleteAuthor'])->name('delete-author');
    Route::get('deactivate/author/{id}', [UserController:: class, 'deactivateAuthor'])->name('deactivate-author');
    Route::get('activate/author/{id}', [UserController:: class, 'activateAuthor'])->name('activate-author');

    Route::get('/users', [UserController:: class, 'users'])->name('users');
    Route::get('/add/user', [UserController:: class, 'addUser'])->name('add-user');
    Route::post('/post/add/user', [UserController:: class, 'postAddUser'])->name('post-add-user');
    Route::get('/edit/user/{id}', [UserController:: class, 'editUser'])->name('edit-user');
    Route::post('/update/user', [UserController:: class, 'updateUser'])->name('update-user');
    Route::get('/user/delete/{id}', [UserController:: class, 'deleteUser'])->name('delete-user');
    Route::get('deactivate/user/{id}', [UserController:: class, 'deactivateUser'])->name('deactivate-user');
    Route::get('activate/user/{id}', [UserController:: class, 'activateUser'])->name('activate-user');

    Route::get('/', [DashboardController:: class, 'index'])->name('dashboard');
});

Route::get('/author/login', [AuthorController:: class, 'login'])->name('author-login');
Route::post('author/post/login', [AuthorController:: class, 'authorPostLogin'])->name('author-post-login');
Route::get('/logout', [AuthorController:: class, 'authorLogout'])->name('logout');
Route::get('/register', [AuthorController:: class, 'register'])->name('register');
Route::post('/post/register', [AuthorController:: class, 'postRegister'])->name('post-register');

Route::name('author-')->middleware(['author'])->prefix('author')->group(function() {
    Route::get('/', [AuthorController:: class, 'dashboard'])->name('dashboard');
    Route::get('/posts', [AuthorController:: class, 'posts'])->name('posts');
    Route::get('add/post', [AuthorController:: class, 'addPost'])->name('add-post');
    Route::post('/post-add-post', [AuthorController:: class, 'postAddPost'])->name('post-add-post');
    Route::get('/view-post/{id}', [AuthorController:: class, 'viewPost'])->name('view-post');
    Route::get('/edit-post/{id}', [AuthorController:: class, 'editPost'])->name('edit-post');
    Route::post('/post-edit-post', [AuthorController:: class, 'postUpdatePost'])->name('post-edit-post');
    Route::get('/post/delete/{id}', [AuthorController:: class, 'deletePost'])->name('delete-post');
    Route::get('comment/{id}', [AuthorController:: class, 'postComment'])->name('comment');
    Route::get('unlike/{id}', [ViewerController:: class, 'unlike'])->name('unlike');
    Route::get('like/{id}', [ViewerController:: class, 'like'])->name('like');
});

Route::get('/login', [ViewerController:: class, 'login'])->name('login');

Route::middleware(['user'])->group(function() {

    Route::get('unlike/{id}', [ViewerController:: class, 'unlike'])->name('unlike');
    Route::get('/', [ViewerController:: class, 'index'])->name('home');
    Route::get('like/{id}', [ViewerController:: class, 'like'])->name('like');
    Route::get('comment/{id}', [ViewerController:: class, 'postComment'])->name('comment');
    Route::get('view/{id}', [ViewerController:: class, 'view'])->name('view');
});
// Route::get('/', [ViewerController:: class, 'index'])->name('home');