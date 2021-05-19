<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro;
use App\Models\Autor;
use App\Models\Assunto;
use App\Models\Editora;

class LivroController extends Controller
{
    // public function estante() {
    //     return view('estante');
    // }

    public function livros() {
        $livros = Livro::all();
        /*
        $livros = Livro::join('livro', 'fk_autor_id', '=', 'autor.id')
                        ->get(['autor.*', 'livro.id', 'livro.titulo', 'livro.ano']);
        */
        //dd($livros);
        
        //return view('livros', ['livros' => $livros]);
        return view('livros', compact('livros'));
    }

    public function create() {
        $autores = Autor::all();
        $assuntos = Assunto::all();
        $editoras = Editora::all();

        return view('livros.create', compact('autores', 'assuntos', 'editoras'));
    }

    // Cria/ salva dados no banco
    public function store(Request $request) {
         $livro = new Livro;

         $livro->titulo = $request->titulo;
         $livro->ano = $request->ano;
         $livro->paginas = $request->paginas;
         $livro->fk_assunto_id = $request->assunto;
         $livro->fk_autor_id = $request->autor;
         $livro->fk_editora_id = $request->editora;

         $livro->save();

         return redirect('/livros');
    }
}
