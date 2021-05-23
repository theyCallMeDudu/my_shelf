<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\AssuntoController;
use App\Http\Controllers\EditoraController;

///////////////////// ADMIN \\\\\\\\\\\\\\\\\\\\\

///// LIVROS
// Rota para os livros cadastrados no sistema pelo admin
Route::get('/livros', [LivroController::class, 'livros']);

// Rota para a página de cadastro de livros
Route::get('/livros/create', [LivroController::class, 'create']);

// Rota para enviar dados de livro para criação (store)
Route::post('/livros', [LivroController::class, 'store']);

// Rota para acessar página de edição de livro
Route::get('/livros/edit/{id}', [LivroController::class, 'edit']);

// Rota para alterar dados de livro (update)
Route::put('/livros/update/{id}', [LivroController::class, 'update']);

// Rota para deletar livro (delete)
Route::delete('/livros/{id}', [LivroController::class, 'destroy']);

Route::post('/imagem/remove', [LivroController::class, 'removeImagem'])->name('remover');


///// ASSUNTOS
// Rota para a página de assuntos cadastrados no sistema
Route::get('/assuntos', [AssuntoController::class, 'assuntos']);

// Rota para a página de cadastro de assuntos
Route::get('/assuntos/create', [AssuntoController::class, 'create']);

// Rota para enviar dados de assunto para criação (store)
Route::post('/assuntos', [AssuntoController::class, 'store']);

// Rota para acessar página de edição de assunto
Route::get('/assuntos/edit/{id}', [AssuntoController::class, 'edit']);

// Rota para alterar dados de assunto (update)
Route::put('/assuntos/update/{id}', [AssuntoController::class, 'update']);

// Rota para deletar livro (delete)
Route::delete('/assuntos/{id}', [AssuntoController::class, 'destroy']);



///// AUTORES
// Rota para a página de autores cadastrados no sistema
Route::get('/autores', [AutorController::class, 'autores']);

// Rota para a página de cadastro de autores
Route::get('/autores/create', [AutorController::class, 'create']);

// Rota para enviar dados de autor para criação (store)
Route::post('/autores', [AutorController::class, 'store']);

// Rota para acessar página de edição de autor
Route::get('/autores/edit/{id}', [AutorController::class, 'edit']);

// Rota para alterar dados de autor (update)
Route::put('/autores/update/{id}', [AutorController::class, 'update']);

// Rota para deletar autor (delete)
Route::delete('/autores/{id}', [AutorController::class, 'destroy']);


///// EDITORAS
// Rota para a página de editoras cadastradas no sistema
Route::get('/editoras', [EditoraController::class, 'editoras']);

// Rota para a página de cadastro de editoras
Route::get('editoras/create', [EditoraController::class, 'create']);

// Rota para enviar dados de editora para criação (store)
Route::post('editoras', [EditoraController::class, 'store']);

// Rota para acessar página de edição de editora
Route::get('/editoras/edit/{id}', [EditoraController::class, 'edit']);

// Rota para alterar dados de editora (update)
Route::put('/editoras/update/{id}', [EditoraController::class, 'update']);

// Rota para deletar editora (delete)
Route::delete('/editoras/{id}', [EditoraController::class, 'destroy']);


///////////////////// USUÁRIO \\\\\\\\\\\\\\\\\\\\\
// Rota para início de usuário não logado
Route::get('/', [LivroController::class, 'index']);

// Rota para a estante de cada usuário (página principal)
Route::get('/estante', [LivroController::class, 'estante']);

// Rota para um livro em detalhe
Route::get('/livros/{id}', [LivroController::class, 'show']);

// Rota para autenticação (login)
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('/dashboard');
})->name('dashboard');
