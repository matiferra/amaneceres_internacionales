<?php

use App\Http\Controllers\Api\ContinenteController;
use App\Http\Controllers\Api\PaisController;
use App\Http\Controllers\DB_Usuarios\DatoController;
use App\Http\Controllers\DB_Usuarios\UserController;
use App\Http\Controllers\DB_Usuarios\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get("/continentes", [ContinenteController::class, 'index']);

Route::get('/continentes/id/{continente}', [ContinenteController::class, 'show']);

Route::get('/paises', [PaisController::class, 'index']);

Route::get('/paises/nombre/{pais}', [PaisController::class, 'show']);

Route::get('/paises/continente/nombre/{continente}', [PaisController::class, 'showXContinente']);

Route::get('/admin/usuario/{id}', [UserController::class, 'show'])->middleware('auth:api');

Route::resource('/admin/datos-usuario', DatoController::class)->only(['show', 'store', 'update', 'destroy'])->middleware('auth:api');
