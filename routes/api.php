<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ViewerController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/blogs', [ViewerController:: class, 'data'])->name('home');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', [PostController::class, 'get']);
Route::delete('/{id}', [PostController::class, 'delete']);
Route::put('/{id}', [PostController::class, 'put']);
Route::post('/post', [PostController::class, 'post']);

// Route::get('/blogs/', );

// Route::delete('/{id}', 'PostController@delete');
// Route::put('/{id}', 'PostController@put');
// Route::post('/', 'PostController@post');
