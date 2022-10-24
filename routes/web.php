<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
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

Route::get('/', [AuthController::class, 'login']);
Route::get('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'register']);
Route::post('/signin', [AuthController::class, 'signin']);
Route::post('/authenticate', [AuthController::class, 'authenticate']);

Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware('auth');

Route::get('/roles', [RolController::class, 'list'])->middleware('auth');
Route::get('/rol', [RolController::class, 'index'])->middleware('auth');
Route::get('/rol/{id}', [RolController::class, 'show'])->middleware('auth');
Route::delete('/rol/{id}', [RolController::class, 'destroy'])->middleware('auth');
Route::post('/rol', [RolController::class, 'store'])->middleware('auth');

Route::get('/usuarios', [UserController::class, 'list'])->middleware('auth');
Route::get('/usuario', [UserController::class, 'index'])->middleware('auth');
Route::get('/usuario/{id}', [UserController::class, 'show'])->middleware('auth');
Route::delete('/usuario/{id}', [UserController::class, 'destroy'])->middleware('auth');
Route::post('/usuario', [UserController::class, 'store'])->middleware('auth');



//Route::get('/user/{id}', [UserController::class, 'show']);
