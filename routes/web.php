<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AjaxController;

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

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/', [HomeController::class, 'index']);
Route::get('/users', [UserController::class, 'all_users']);
Route::get('/logout', [UserController::class, 'logout']);
Route::get('/login', [UserController::class, 'login']);
Route::post('/login', [UserController::class, 'login_post']);
Route::get('/register', [UserController::class, 'register']);
Route::post('/register', [UserController::class, 'register_post']);
// Route::get('/', [MessageController::class, 'index']);

Route::post('createMessage', [AjaxController::class, 'createMessage'])->name('createMessage.post');