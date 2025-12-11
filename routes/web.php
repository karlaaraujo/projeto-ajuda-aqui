<?php

use App\Http\Controllers\AcaoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/acoes', [AcaoController::class, 'listar'])->name('acoes.listar');

Route::get('/acoes/hoje', [AcaoController::class, 'listarHoje'])->name('acoes.listar.hoje');

Route::get('/acoes/{acao}', [AcaoController::class, 'show'])->name('acoes.show');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [AcaoController::class, 'create'])->name('dashboard');
    Route::post('/acoes', [AcaoController::class, 'store'])->name('acoes.store');
    Route::get('/cadastrar-acao', [AcaoController::class, 'create'])->name('cadastro.acao');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
