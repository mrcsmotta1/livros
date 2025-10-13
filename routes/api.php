<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssuntoController;
use App\Http\Controllers\AutorController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/autores/search', [AutorController::class, 'search'])->name('api.autores.search');

Route::get('/assuntos/search', [AssuntoController::class, 'search'])->name('api.assuntos.search');
