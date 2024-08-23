<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\Api\V1\UserController;
use  App\Http\Controllers\Api\V1\RolController;
use  App\Http\Controllers\Api\V1\LoginController;
use App\Http\Controllers\Api\V1\TipoMuestraController;
use App\Http\Controllers\Api\V1\PoblacionController;


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
