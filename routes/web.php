<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AssuntoController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\LivrosController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\RelatorioAutorController;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('index');
    }

    return view('home');
});

Route::middleware('auth')->group(function () {
    Route::get('/index', [IndexController::class, 'index'])->name('index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('assuntos', AssuntoController::class)->whereNumber('assunto');
    Route::resource('autores', AutorController::class)->whereNumber('autore');
    Route::resource('livros', LivrosController::class)->whereNumber('livro');

    Route::prefix('relatorios/autores')->group(function () {
        Route::get('/', [RelatorioAutorController::class, 'index'])->name('relatorios.autores.index');
        Route::get('/csv', [RelatorioAutorController::class, 'exportCsv'])->name('relatorios.autores.csv');
    });
});

require __DIR__ . '/auth.php';
