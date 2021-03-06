<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\AssuntoController;
use App\Http\Controllers\EditoraController;
use App\Http\Controllers\UserLivroController;
use App\Http\Controllers\UserController;

///////////////////// ADMIN \\\\\\\\\\\\\\\\\\\\\


///// GESTÃO
Route::get('/admin/gestao', [UserController::class, 'usuarios']);

// Rota para conceder acesso de administrador
Route::post('/user/admin', [UserController::class, 'concedeAcesso'])->name('isAdmin');

// Rota para revogar acesso de administrador
Route::post('/user/notadmin', [UserController::class, 'revogaAcesso'])->name('isNotAdmin');

///// LIVROS
// Rota para os livros cadastrados no sistema pelo admin
Route::get('/livros', [LivroController::class, 'livros'])->middleware('admin');

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

// Rota para deletar imagem de capa
Route::post('/imagem/remove', [LivroController::class, 'removeImagem'])->name('remover');

// Rota para catálogo
Route::get('/catalogo', [LivroController::class, 'catalogo']);

// Rota para pesquisar no catálogo de forma dinâmica
Route::post('/pesquisa-catalogo/{assunto?}/{titulo?}/{autor?}/{editora?}', [LivroController::class, 'pesquisaCatalogo'])->name('pesquisaCatalogo');

// Rota para pesquisar em livros de forma dinâmica (admin)
//Route::post('/pesquisa-livros/{assunto?}/{titulo?}/{autor?}/{editora?}', [LivroController::class, 'pesquisaLivros'])->name('pesquisaLivros');




///// ASSUNTOS
// Rota para a página de assuntos cadastrados no sistema
Route::get('/assuntos', [AssuntoController::class, 'assuntos'])->middleware('admin');

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
Route::get('/autores', [AutorController::class, 'autores'])->middleware('admin');

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
Route::get('/editoras', [EditoraController::class, 'editoras'])->middleware('admin');

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
Route::get('/estante', [UserLivroController::class, 'estante'])->middleware('auth');

// Rota para um livro do catálogo em detalhe
Route::get('/livros/{id?}', [LivroController::class, 'show'])->name('verBook');


// Rota para autenticação (login)
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('/dashboard');
})->name('dashboard');

// Rota para adicionar um livro à estante
Route::post('/estante', [UserLivroController::class, 'adicionaLivro'])->name('adicionar');

// Rota para um livro da estante em detalhe
Route::get('/estante-detalhe/{id}', [UserLivroController::class, 'show']);

// Rota para trazer status do livro de um usuário
Route::post('/livro-status/{id}', [UserLivroController::class, 'pesquisaStatus'])->name('pesquisar');

// Rota para atualizar status do livro de um usuário
Route::post('/status-update', [UserLivroController::class, 'atualizaStatus'])->name('atualizar');

// Rota para 'Minha Conta' (comum a todos os usuários)
Route::get('/minha-conta', [UserController::class, 'minhaConta']);

// Rota para atualizar dados usuário
Route::post('/minha-conta/update/{id}', [UserController::class, 'update'])->name('updateUser');

// Rota para deletar editora (delete)
Route::delete('/minha-conta/{id}', [UserController::class, 'excluiUsuario'])->name('excluir');

// Rota para deletar imagem de perfil
Route::post('/foto/remove', [UserController::class, 'removeFoto'])->name('removerFoto');


// Rota para deletar livro da estante
Route::post('/estante/remove', [UserLivroController::class, 'removeLivro'])->name('removerDaEstante');

// Rota após deletar usuário
Route::get('/no-user', [UserController::class, 'noUser'])->name('no-user');