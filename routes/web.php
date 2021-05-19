<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\LivroController;

// Rota para a estante de cada usuário (página principal)
Route::get('/estante', [LivroController::class, 'estante']);

// Rota para os livros cadastrados no sistema pelo admin
Route::get('/livros', [LivroController::class, 'livros']);

// Rota para a página de cadastro de livros no sistema
Route::get('/livros/create', [LivroController::class, 'create']);

// Rota para enviar dados de livro para criação
Route::post('/livros', [LivroController::class, 'store']);

Route::get('/livro/{id}', function ($id) {
    return view('livro', ['id' => $id]);
});