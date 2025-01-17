<?php

use App\Http\Controllers\DB_Usuarios\UserController;
use App\Http\Controllers\PaisController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('/admin/paises', PaisController::class)->except("show", "index")->parameters([
    'paises' => 'pais'
])->middleware("auth:admin");

Route::get('/admin/paises',[PaisController::class, 'index'])->name('admin.home')->middleware("auth:admin");

Route::resource('/admin/usuarios', UserController::class)->except("show")->parameters([
    'usuarios' => 'usuario'
])->middleware("auth:admin");

