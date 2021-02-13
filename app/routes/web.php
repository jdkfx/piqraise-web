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
    return view('welcome');
});

// Auth Twitter
Route::get('/login/auth/twitter', 'Auth\AuthController@TwitterRedirect');
Route::get('/login/auth/twitter/callback', 'Auth\AuthController@TwitterCallback');
Route::get('/logout/auth/twitter', 'Auth\AuthController@getLogout');

Route::get('/todos', 'TodosController@index');