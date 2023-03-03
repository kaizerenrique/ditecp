<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DitecpController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/consultarusdbcv',[DitecpController::class,'consultarValorUsd'])->middleware('auth:sanctum');

Route::post('/consultarCedulaCne',[DitecpController::class,'consultarCedulaCne'])->middleware('auth:sanctum');

Route::post('/consultarCedulaIvssPension',[DitecpController::class,'consultaIvssPensionado'])->middleware('auth:sanctum');

Route::post('/consultarCedulaIvss',[DitecpController::class,'consultarCuentaIndividualIvss'])->middleware('auth:sanctum');

Route::post('/apiwha',[DitecpController::class,'apiwha'])->middleware('auth:sanctum');

Route::get('/apiwhawebhooks',[DitecpController::class,'apiwhawebhooks']);
Route::post('/apiwhawebhooks',[DitecpController::class,'apiprocesobhooks']);

Route::get('/datosconexion',[DitecpController::class,'datosconexion'])->middleware('auth:sanctum');