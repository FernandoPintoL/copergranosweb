<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\AdministrativoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/categorias/search', [CategoriaController::class, 'search'])->name('categorias.search');
Route::get('/administrativos/search', [AdministrativoController::class, 'search'])->name('administrativos.search');
Route::get('/productos/search', [ProductoController::class, 'search'])->name('productos.search');
