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

//Route::prefix('core')->group(function() {
//    Route::get('/', 'CoreController@index');
//});


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Modules\Core\Http\Controllers\CoreController;

Route::get('/home', [CoreController::class, 'home'])->name('home');


// Welcome page is handled here showing the default laravel welcome page with products
Route::get('/', [CoreController::class, 'index'])->name('index');

// login and register
Auth::routes();
// check Core Route for more routes
