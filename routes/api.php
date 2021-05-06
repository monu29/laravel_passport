<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ItemController;


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


Route::post('/register', [UserController::class, 'register']);
Route::get('/login', [UserController::class, 'login'])->name('login');

Route::post('/login', [UserController::class, 'login']);

Route::group(['middleware' => 'auth:api'], function(){

	Route::get('/stores', [StoreController::class, 'index']);
	Route::post('/stores', [StoreController::class, 'index']);
	Route::post('/items', [ItemController::class, 'index']);
	Route::get('/getItems', [ItemController::class, 'getItems']);

});

