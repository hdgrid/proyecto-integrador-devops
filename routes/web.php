<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarComparatorController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/comparador', [CarComparatorController::class, 'index'])->name('car.comparator');
