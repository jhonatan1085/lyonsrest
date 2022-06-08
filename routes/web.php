<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\UsersController;
use App\Http\Livewire\EstadocuentaController;
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
    return view('auth.login');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', EstadocuentaController::class);

Route::get('users', UsersController::class);
Route::get('estadocuenta', EstadocuentaController::class);