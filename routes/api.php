<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\AdministrativoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

