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

Route::prefix('cinema')->group(function () {
    Route::get('/', 'CinemaController@index')->name('cinemas');
    Route::get('/show/{id}', 'CinemaController@show')->name('cinema.show');
});
