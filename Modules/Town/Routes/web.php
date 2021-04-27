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
//
//Route::prefix('town')->group(function() {
//    Route::get('/', 'TownController@index');
//});

use Illuminate\Support\Facades\Route;

Route::post('town/change', 'TownController@changeTown')->name('town.change');
