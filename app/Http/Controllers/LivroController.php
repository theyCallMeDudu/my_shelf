<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro;
use App\Models\Autor;
use App\Models\Assunto;
use App\Models\Editora;
use App\Models\CapaLivro;
use App\Models\Status;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class LivroController extends Controller
{
    public function index() {
        //$ultimos = Livro::latest()->take(5)->get();
        $ultimos = Livro::orderBy('id', 'desc')->take(8)->get();
        //$is_admin = Auth::user()->is_admin;

        return view('welcome', compact('ultimos'));
    }

    public function estante() {
        $search = request('search');
        $teste = Livro::where('id', 15)->first();
        $user = Auth::user();
        $is_admin = Auth::user()->is_admin;

        if ($search) {
            
            $livros = Livro::where([
                ['titulo', 'like', '%'.$search.'%']
            ])->get();

        } else {
            $livros = Livro::all();
        }

        return view('estante', compact('livros', 'search', 'user', 'is_admin'));
    }

    public function show($id) {
        $livro = Livro::findOrFail($id);
        $status = Status::all();
        $user = Auth::id();
        $is_admin = Auth::user()->is_admin;

        //$autor = new Autor();

        //$autor = DB::select("SELECT autor.nome FROM autor INNER JOIN livro ON livro.id = $id and livro.fk_autor_id = autor.id");

        return view('livros.show', compact('livro', 'status', 'user', 'is_admin'));
    }

    public function livros() {
        $livros = Livro::all();
        $autores = Autor::all();
        
        // dd($livros->relAutor->nome);

        //$livros = new Livro();
        //$livros->retornoLivro('');
        // dd($teste->retornoLivro(''));

        $livros = DB::select("SELECT l.id, l.titulo, l.ano, a.nome FROM livro as l INNER JOIN autor as a ON l.fk_autor_id = a.id;");
        //$livros = DB::select('select * from livro');
        //dd($livros);

        //return view('livros', ['livros' => $livros]);
        return view('livros', compact('livros', 'autores'));
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
         $livro->save();

         // Upload de imagem
         if ($request->hasFile('image')) {
            $capa = $this->uploadCapa($request);

            CapaLivro::create([
                 'nome' => $capa,
                 'fk_livro_id' => $livro->id
            ]);
         }


         return redirect('/livros')->with('msg', 'Livro cadastrado com sucesso!');
    }

    private function uploadCapa(Request $request) {
        $capa = $request->file('image');

        $uploadCapa = $capa->store('capa', 'public');

        return $uploadCapa;
    }

    public function removeImagem(Request $request) {

        $capa = $request->get('imagemCapa');
        
        // Remover a imagem da pasta
        if (Storage::disk('public')->exists($capa)) {
            Storage::disk('public')->delete($capa);
        }

        // Remover imagem do banco
        $deletaImagem = CapaLivro::where('nome', $capa);
        $deletaImagem->delete();

    }

    // 
    public function edit($id) {
        $livro = Livro::findOrFail($id);
        $autores = Autor::all();
        $assuntos = Assunto::all();
        $editoras = Editora::all();
        
        //dd($livro->relCapaLivro);

        return view('livros.edit', compact('livro', 'autores', 'assuntos', 'editoras'));
    }

    public function update(Request $request) {

        $data = $request->all();
        
        // Upload de imagem
        if ($request->hasFile('image')) {
            $capa = $this->uploadCapa($request);

            CapaLivro::create([
                 'nome' => $capa,
                 'fk_livro_id' => $request->id
            ]);
         }
        
        Livro::findOrFail($request->id)->update($data);

        return redirect('/livros')->with('msg', 'Livro editado com sucesso!');

    }

    public function destroy($id) {
        Livro::findOrFail($id)->delete();

        return redirect('/livros')->with('msg', 'Livro excluído com sucesso!');
    }
}
