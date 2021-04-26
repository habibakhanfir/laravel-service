<?php

use Illuminate\Support\Facades\Route;



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

/* User API
*/

Route::post('/user/register', [\App\Http\Controllers\UserController::class, 'register']);
Route::post('/user/login', [\App\Http\Controllers\UserController::class, 'login']);

/*
    post API

*/

//listing posts
Route::get('/post', [\App\Http\Controllers\PostController::class, 'listing'])->middleware('auth');

//create post
Route::post('/post', [\App\Http\Controllers\PostController::class, 'create'])->middleware('auth');

//get post by id
Route::get('/post/{id}', [\App\Http\Controllers\PostController::class, 'get']);

//Edit Post
Route::put('/post/{id}', [\App\Http\Controllers\PostController::class, 'edit'])->middleware('auth');

//delete post
Route::delete('/post/{id}', [\App\Http\Controllers\PostController::class, 'delete'])->middleware('auth');


///////////////////////////////////////////////
//like post
Route::post('/post/{id}', [\App\Http\Controllers\PostController::class, 'like'])->middleware('auth');




