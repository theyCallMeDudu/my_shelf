<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro;
use App\Models\Autor;
use App\Models\Assunto;
use App\Models\Editora;
use Illuminate\Support\Facades\DB;

class LivroController extends Controller
{
    public function estante() {
        $livros = Livro::all();

        return view('estante', compact('livros'));
    }

    public function show($id) {
        $livro = Livro::findOrFail($id);
        //$autor = new Autor();

        //$autor = DB::select("SELECT autor.nome FROM autor INNER JOIN livro ON livro.id = $id and livro.fk_autor_id = autor.id");

        return view('livros.show', compact('livro'));
    }

    public function livros() {
        $livros = Livro::all();

        //$livros = new Livro();
        //$livros->retornoLivro('');
        // dd($teste->retornoLivro(''));

        //$livros = DB::select("SELECT * FROM livro INNER JOIN autor ON livro.fk_autor_id = autor.id");
        //$livros = DB::select('select * from livro');
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

    // Insere dados no banco
    public function store(Request $request) {
         $livro = new Livro;

         $livro->titulo = $request->titulo;
         $livro->ano = $request->ano;
         $livro->paginas = $request->paginas;
         $livro->fk_assunto_id = $request->assunto;
         $livro->fk_autor_id = $request->autor;
         $livro->fk_editora_id = $request->editora;

         // Upload de imagem
         if ($request->hasFile('image') && $request->file('image')->isValid()) {
            
            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension; 

            $requestImage->move(public_path('img/capas'), $imageName);

            $livro->image = $imageName;
            
         }

         $livro->save();

         return redirect('/livros')->with('msg', 'Livro cadastrado com sucesso!');
    }

    // 
    public function edit($id) {
        $livro = Livro::findOrFail($id);
        $autores = Autor::all();
        $assuntos = Assunto::all();
        $editoras = Editora::all();

        return view('livros.edit', compact('livro', 'autores', 'assuntos', 'editoras'));
    }

    public function update(Request $request) {

        $data = $request->all();
        
        // Upload de imagem
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            
            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension; 

            $requestImage->move(public_path('img/capas'), $imageName);

            $data['image'] = $imageName;
         }
        
        Livro::findOrFail($request->id)->update($data);

        return redirect('/livros')->with('msg', 'Livro editado com sucesso!');

    }

    public function destroy($id) {
        Livro::findOrFail($id)->delete();

        return redirect('/livros')->with('msg', 'Livro excluído com sucesso!');
    }
}
