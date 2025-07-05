<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\SocialiteController;

// Ventas
use App\Http\Controllers\Ventas\PuntoDeVentaController;
use App\Http\Controllers\Ventas\VentasIndexController;
use App\Http\Controllers\Ventas\NotasDeVentaController;
use App\Http\Controllers\Ventas\RegistroCajaController;
use App\Http\Controllers\Ventas\FacturacionController;
use App\Http\Controllers\Ventas\ComplementosPagoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [DashboardController::class, 'index']);
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Ventas Section
Route::prefix('ventas')->name('ventas.')->group(function () {
    Route::get('/', [VentasIndexController::class, 'index'])->name('index');
    Route::get('/punto-de-venta', [PuntoDeVentaController::class, 'index'])->name('punto-de-venta');
    Route::get('/notas-de-venta', [NotasDeVentaController::class, 'index'])->name('notas-de-venta');

    Route::resource('registro-en-caja', RegistroCajaController::class);

    Route::get('/facturacion-4-0', [FacturacionController::class, 'index'])->name('facturacion-4-0');
    Route::get('/complementos-de-pago', [ComplementosPagoController::class, 'index'])->name('complementos-de-pago');
});

// Error test route
Route::get('/error', fn () => abort(500));

// API for AJAX modal (RegistroCaja show)
Route::get('/api/registro-en-caja/{id}', function ($id) {
    return \App\Models\RegistroCaja::findOrFail($id);
});

// Social login (optional — remove if not used)
Route::get('/auth/redirect/{provider}', [SocialiteController::class, 'redirect']);

// Removed: require __DIR__ . '/auth.php';