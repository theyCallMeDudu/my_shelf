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

// Rota para acessar um livro em detalhes
Route::get('/livro/{id}', function ($id) {
    return view('livro', ['id' => $id]);
});


///// ASSUNTOS
// Rota para a página de assuntos cadastrados no sistema
Route::get('/assuntos', [AssuntoController::class, 'assuntos']);

// Rota para a página de cadastro de assuntos
Route::get('/assuntos/create', [AssuntoController::class, 'create']);

// Rota para enviar dados de assunto para criação (store)
Route::post('/assuntos', [AssuntoController::class, 'store']);


///// AUTORES
// Rota para a página de autores cadastrados no sistema
Route::get('/autores', [AutorController::class, 'autores']);

// Rota para a página de cadastro de autores
Route::get('/autores/create', [AutorController::class, 'create']);

// Rota para enviar dados de autor para criação (store)
Route::post('/autores', [AutorController::class, 'store']);


///// EDITORAS
// Rota para a página de editoras cadastradas no sistema
Route::get('/editoras', [EditoraController::class, 'editoras']);

// Rota para a página de cadastro de editoras
Route::get('editoras/create', [EditoraController::class, 'create']);

// Rota para enviar dados de editora para criação (store)
Route::post('editoras', [EditoraController::class, 'store']);



///////////////////// USUÁRIO \\\\\\\\\\\\\\\\\\\\\

// Rota para a estante de cada usuário (página principal)
Route::get('/estante', [LivroController::class, 'estante']);