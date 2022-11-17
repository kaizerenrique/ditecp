<?php

use App\Http\Livewire\Administracion\Perfiles;
use App\Http\Livewire\Administracion\TokenInfo;
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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// rutas de administracion del sistema 
Route::middleware(['auth:sanctum', 'verified'])->get('administracion/usuarios', function () {
    return view('administracion/usuarios');
})->name('usuarios');

//ruta del perfil del usuario
Route::middleware(['auth:sanctum', 'verified'])->get('administracion/usuarios/{id}', Perfiles::class)->name('perfiles');

//ruta de la informacion detallada del token
Route::middleware(['auth:sanctum', 'verified'])->get('administracion/tokeninfo/{id}', TokenInfo::class)->name('informaciontoken');

//ruta de servicios
Route::middleware(['auth:sanctum', 'verified'])->get('administracion/servicios', function () {
    return view('administracion/servicios');
})->name('servicios');