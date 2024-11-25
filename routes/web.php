<?php

use App\Http\Controllers\AdministrativoController;
use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\DetalleCompraController;
use App\Http\Controllers\EnvioController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\MedidaController;
use App\Http\Controllers\MetodoPagoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\SeguimientoController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::resource('users', UserController::class);

    Route::resource('administrativos', AdministrativoController::class);
    Route::resource('almacenes', AlmacenController::class);
    Route::resource('categorias', CategoriaController::class);
    Route::resource('clientes', ClienteController::class);
    Route::resource('compras', CompraController::class);
    Route::resource('detalles', DetalleCompraController::class);
    Route::resource('envios', EnvioController::class);
    Route::resource('inventario', InventarioController::class);
    Route::resource('medidas', MedidaController::class);
    Route::resource('metodoPago', MetodoPagoController::class);
    Route::resource('pagos', PagoController::class);
    Route::resource('productos', ProductoController::class);
    Route::resource('proveedores', ProveedorController::class);
    Route::resource('seguimientos', SeguimientoController::class);
});
