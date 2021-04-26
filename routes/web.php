<?php

use App\Http\Controllers\UserController;

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/testMongo', 'App\Http\Controllers\TestController@test');

Route::get('/register', 'App\Http\Controllers\UserController@register');

//Route::resource('/register', 'App\Http\Controllers\UserController');
//Route::post('register', [UserController::class, 'register']);

Route::get('/home', function(){
    return view('home.index');
}) ->name('home');

/*Route::get('/register', [\App\Http\Controllers\Auth\RegisterController::class , 'index'])->name('register') ->name('register');

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');


Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'index'])->name('login');*/
