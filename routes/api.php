<?php

use App\Http\Controllers\Api\v1\ExamenController;
use App\Http\Controllers\Api\V1\ResultadoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\Api\V1\UserController;
use  App\Http\Controllers\Api\V1\RolController;
use  App\Http\Controllers\Api\V1\LoginController;
use App\Http\Controllers\Api\V1\TipoMuestraController;
use App\Http\Controllers\Api\V1\PoblacionController;
use App\Http\Controllers\Api\V1\PersonalController;
use App\Http\Controllers\Api\V1\EstablecimientoController;
use App\Http\Controllers\Api\V1\OrdenController;
use App\Http\Controllers\Api\V1\OrdenDetalleController;
use App\Http\Controllers\Api\V1\InventarioController;
use App\Http\Controllers\Api\v1\CategoriaController;
use App\Http\Controllers\Api\V1\UnidadMedidaController;
use App\Http\Controllers\Api\V1\SexoController;
use App\Http\Controllers\Api\V1\EstadoCivilController;
use App\Http\Controllers\Api\V1\UbigeoController;
use App\Http\Controllers\Api\V1\TipoDocIdentidadController;
use App\Http\Controllers\Api\V1\ParentescoController;
use App\Http\Controllers\Api\V1\ViaController;
use App\Http\Controllers\Api\V1\PacienteController;

Route::post('v1/login', [loginController::class, 'login']);
Route::post('v1/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');

Route::apiResource('v1/user', UserController::class)
    ->only(['index','show','destroy','update','store']);
    /*->middleware('auth:sanctum');*/

Route::apiResource('v1/rol', RolController::class)
    ->only(['index','show','destroy','update','store'])
    ->middleware('auth:sanctum');
Route::apiResource('v1/tipomuestra', TipoMuestraController::class)
    ->only(['index','show','destroy','update','store'])
    ->middleware('auth:sanctum');
Route::apiResource('v1/poblacion', PoblacionController::class)
    ->only(['index','show','destroy','update','store'])
    ->middleware('auth:sanctum');
Route::apiResource('v1/examen', ExamenController::class)
    ->only(['index','show','destroy','update','store'])
    ->middleware('auth:sanctum');
Route::apiResource('v1/resultado', ResultadoController::class)
    ->only(['index','show','destroy','update','store'])
    ->middleware('auth:sanctum');
Route::apiResource('v1/personal', PersonalController::class)
    ->only(['index','show','destroy','update','store'])
    ->middleware('auth:sanctum');
Route::apiResource('v1/establecimiento', EstablecimientoController::class)
    ->only(['index','show','destroy','update','store'])
    ->middleware('auth:sanctum');
Route::apiResource('v1/orden', OrdenController::class)
    ->only(['index','show','destroy','update','store'])
    ->middleware('auth:sanctum');
Route::apiResource('v1/detalleorden', OrdenDetalleController::class)
    ->only(['index','show','destroy','update','store'])
    ->middleware('auth:sanctum');
Route::apiResource('v1/inventario', InventarioController::class)
    ->only(['index','show','destroy','update','store'])
    ->middleware('auth:sanctum');
Route::apiResource('v1/categoria', CategoriaController::class)
    ->only(['index','show','destroy','update','store'])
    ->middleware('auth:sanctum');
Route::apiResource('v1/unidadmedida', UnidadMedidaController::class)
    ->only(['index','show','destroy','update','store'])
    ->middleware('auth:sanctum');
Route::apiResource('v1/sexo', SexoController::class)
    ->only(['index','show','destroy','update','store'])
    ->middleware('auth:sanctum');
Route::apiResource('v1/estadocivil', EstadoCivilController::class)
    ->only(['index','show','destroy','update','store'])
    ->middleware('auth:sanctum');
Route::apiResource('v1/ubigeo', UbigeoController::class)
    ->only(['index','show','destroy','update','store'])
    ->middleware('auth:sanctum');
Route::apiResource('v1/tipodoc', TipoDocIdentidadController::class)
    ->only(['index','show','destroy','update','store'])
    ->middleware('auth:sanctum');
Route::apiResource('v1/via', ViaController::class)
    ->only(['index','show','destroy','update','store'])
    ->middleware('auth:sanctum');
Route::apiResource('v1/parentesco', ParentescoController::class)
    ->only(['index','show','destroy','update','store'])
    ->middleware('auth:sanctum');
Route::apiResource('v1/paciente', PacienteController::class)
    ->only(['index','show','destroy','update','store'])
    ->middleware('auth:sanctum');
