<?php

use App\Http\Controllers\UsersController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [UsersController::class, 'index'])->name('index');
Route::post('/registro/usuario', [UsersController::class, 'create'])->name('create');
Route::get('/exportar/excel', [UsersController::class, 'excel'])->name('exporExcel');
Route::get('/ciudades', [UsersController::class, 'showCiudades'])->name('ciudad');