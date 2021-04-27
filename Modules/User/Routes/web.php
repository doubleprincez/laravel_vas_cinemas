<?php

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

use Illuminate\Support\Facades\Route;

//Route::prefix('user')->group(function() {
Route::get('/watch', 'UserController@watch')->name('watch');

Route::post('/watch', 'UserController@store_watch')->name('watch');

Route::get('/watched', 'UserController@watched')->name('watched');
//});
