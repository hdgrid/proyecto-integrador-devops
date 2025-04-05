<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarComparatorController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/comparador', [CarComparatorController::class, 'index'])->name('comparador');
Route::post('/comparador/modelos', [CarComparatorController::class, 'getModelos'])->name('getModelos');
Route::post('/comparador/versiones', [CarComparatorController::class, 'getVersiones'])->name('getVersiones');
Route::post('/comparador/auto-detalle', [CarComparatorController::class, 'getAutoDetalle'])->name('getAutoDetalle');
Route::post('/comparador/detallado', [CarComparatorController::class, 'comparacionDetallada'])->name('comparacionDetallada');
