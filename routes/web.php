<?php

use App\Http\Controllers\LibroController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EditorialController;
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
Route::get('/login', [AuthController::class, 'login'])->name('login');
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

Route::get('/autores', [AutorController::class, 'list'])->middleware('auth');
Route::get('/autor', [AutorController::class, 'index'])->middleware('auth');
Route::get('/autor/{id}', [AutorController::class, 'show'])->middleware('auth');
Route::delete('/autor/{id}', [AutorController::class, 'destroy'])->middleware('auth');
Route::post('/autor', [AutorController::class, 'store'])->middleware('auth');

Route::get('/categorias', [CategoriaController::class, 'list'])->middleware('auth');
Route::get('/categoria', [CategoriaController::class, 'index'])->middleware('auth');
Route::get('/categoria/{id}', [CategoriaController::class, 'show'])->middleware('auth');
Route::delete('/categoria/{id}', [CategoriaController::class, 'destroy'])->middleware('auth');
Route::post('/categoria', [CategoriaController::class, 'store'])->middleware('auth');

Route::get('/editoriales', [EditorialController::class, 'list'])->middleware('auth');
Route::get('/editorial', [EditorialController::class, 'index'])->middleware('auth');
Route::get('/editorial/{id}', [EditorialController::class, 'show'])->middleware('auth');
Route::delete('/editorial/{id}', [EditorialController::class, 'destroy'])->middleware('auth');
Route::post('/editorial', [EditorialController::class, 'store'])->middleware('auth');

Route::get('/libros', [LibroController::class, 'list'])->middleware('auth');
Route::get('/libro', [LibroController::class, 'index'])->middleware('auth');
Route::get('/libro/{id}', [LibroController::class, 'show'])->middleware('auth');
Route::delete('/libro/{id}', [LibroController::class, 'destroy'])->middleware('auth');
Route::post('/libro', [LibroController::class, 'store'])->middleware('auth');
Route::get('/libro/viewer/{id}', [LibroController::class, 'viewer'])->middleware('auth');



