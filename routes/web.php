<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LiteraryGenreController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\BookLoanController;
use App\Http\Controllers\GenerativeAiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboard');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'listData']); 

// Gênero
Route::get('/generos-literarios', [LiteraryGenreController::class, 'listData']);

Route::get('/generos-literarios/cadastro', [LiteraryGenreController::class, 'formData']);
Route::post('/generos-literarios/cadastro', [LiteraryGenreController::class, 'saveData']);

Route::get('/generos-literarios/{id}/editar', [LiteraryGenreController::class, 'edit']);
Route::delete('/generos-literarios/{id}/excluir', [LiteraryGenreController::class, 'delete']);


// Livros 
Route::get('/acervo', [BookController::class, 'listData']);

Route::get('/acervo/cadastro', [BookController::class, 'formData']);
Route::post('/acervo/cadastro', [BookController::class, 'saveData']);

Route::get('/acervo/{id}/editar', [BookController::class, 'edit']);
Route::delete('/acervo/{id}/excluir', [BookController::class, 'delete']);

// IA
Route::get('/acervo/{id}/ia/sinopse', [GenerativeAiController::class, 'getSynopsis']);


// Pessoas
Route::get('/pessoas', [PersonController::class, 'listData']);

Route::get('/pessoas/cadastro', [PersonController::class, 'formData']);
Route::post('/pessoas/cadastro', [PersonController::class, 'saveData']);

Route::get('/pessoas/{id}/editar', [PersonController::class, 'edit']);
Route::delete('/pessoas/{id}/excluir', [PersonController::class, 'delete']);

// Reservas
Route::get('/retiradas', [BookLoanController::class, 'listData']);

Route::get('/retiradas/cadastro', [BookLoanController::class, 'formData']);
Route::post('/retiradas/cadastro', [BookLoanController::class, 'saveData']);

Route::get('/retiradas/{id}/editar', [BookLoanController::class, 'edit']);
Route::delete('/retiradas/{id}/excluir', [BookLoanController::class, 'delete']);
