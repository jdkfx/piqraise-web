<?php

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
    return view('pages.index');
});

// Auth Twitter
Route::get('/login/auth/twitter', 'Auth\AuthController@TwitterRedirect')->name('login');
Route::get('/login/auth/twitter/callback', 'Auth\AuthController@TwitterCallback');
Route::get('/logout/auth/twitter', 'Auth\AuthController@getLogout');

Route::group(['middleware' => ['auth']], function () {
  Route::get('/{userId}', 'UsersController@index');
});

Route::group(['middleware' => ['auth']], function() {
  Route::apiResource('/todo', 'TodoController');
});
