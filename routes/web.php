<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GeneroController;
use App\Http\Controllers\LivrosController;
use App\Http\Controllers\PessoaController;
use App\Http\Controllers\RetiradaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboard');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'dashboard']); 

// Gênero
Route::get('/generos-literarios', [GeneroController::class, 'listaGeneros']);

Route::get('/generos-literarios/cadastro', [GeneroController::class, 'cadastroGenero']);
Route::post('/generos-literarios/cadastro', [GeneroController::class, 'salvarGenero']);

Route::get('/generos-literarios/{id}/editar', [GeneroController::class, 'editar']);
Route::delete('/generos-literarios/{id}/excluir', [GeneroController::class, 'excluir']);


// Livros 
Route::get('/acervo', [LivrosController::class, 'listaLivros']);

Route::get('/acervo/cadastro', [LivrosController::class, 'cadastroLivros']);
Route::post('/acervo/cadastro', [LivrosController::class, 'salvarLivros']);

Route::get('/acervo/{id}/editar', [LivrosController::class, 'editar']);
Route::delete('/acervo/{id}/excluir', [LivrosController::class, 'excluir']);


// Pessoas
Route::get('/pessoas', [PessoaController::class, 'listaPessoas']);

Route::get('/pessoas/cadastro', [PessoaController::class, 'cadastroPessoas']);
Route::post('/pessoas/cadastro', [PessoaController::class, 'salvarPessoas']);

Route::get('/pessoas/{id}/editar', [PessoaController::class, 'editar']);
Route::delete('/pessoas/{id}/excluir', [PessoaController::class, 'excluir']);

// Reservas
Route::get('/retiradas', [RetiradaController::class, 'listaRetiradas']);

Route::get('/retiradas/cadastro', [RetiradaController::class, 'cadastroReservas']);
Route::post('/retiradas/cadastro', [RetiradaController::class, 'salvarReservas']);

Route::get('/retiradas/{id}/editar', [RetiradaController::class, 'editar']);
Route::delete('/retiradas/{id}/excluir', [RetiradaController::class, 'excluir']);
