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

    public function catalogo() {
        $is_admin = Auth::user()->is_admin;
        $autores = Autor::all();
        $assuntos = Assunto::all();
        $editoras = Editora::all();
        $livros = Livro::all();
        
        return view('catalogo', compact('is_admin', 'autores', 'assuntos', 'editoras', 'livros'));
    }

    public function pesquisaCatalogo(Request $request) {
        $livro = new Livro();
        $catalogo = $livro->retornoLivro($request->autor, $request->assunto, $request->editora, $request->titulo);

        $resultado = "";
        $resultado .="<table class='table table-bordered text-center' id='table-catalogo'>";
        $resultado .="<thead>";
        $resultado .="<tr>";        
        // $resultado .="<th>Id</th>";       
        $resultado .="<th>Título</th>";
        $resultado .="<th>Autor</th>";
        $resultado .="<th>Ano</th>";
        $resultado .="<th>Editora</th>";
        $resultado .="<th>Capa</th>";
        $resultado .="<th>Ações</th>"; 
        $resultado .="</tr>";
        $resultado .="</thead>";
        $resultado .="<tbody>";
            if ($catalogo != null) {
                foreach($catalogo as $cat) {
                    $resultado .="<tr>";
                    // $resultado .="<td> {$cat->id}</td>";
                    $resultado .="<td> {$cat->titulo}</td>";
                    $resultado .="<td> {$cat->autor}</td>";
                    $resultado .="<td> {$cat->ano}</td>";
                    $resultado .="<td> {$cat->editora}</td>";
                    if ($cat->capa != null) {
                        $resultado .="<td> <img class='capa-livro-estante' src=" .asset('storage/' . $cat->capa). " style='width:45px; height:55px; margin-bottom: 1px;'  alt=" .$cat->titulo. "> </td>";    
                    } else {
                        $resultado .="<td> <img class='capa-livro-estante' src= '/img/sem_capa.png' style='width:45px; height:55px; margin-bottom: 1px;' alt=" .$cat->titulo. "> </td>";
                    }
                    $resultado .="<td><a class='btn btn-primary btn-sm' style='background: black; border: none; margin-top:10px;' href=".'/livros/'. $cat->id ."><i class='fas fa-search' data-toggle='tooltip' data-placement='top' title='Visualizar livro'></i></a>&nbsp";
                    $resultado .="</tr>";
                }
            }
            else {
                $resultado.="<tr>";
                $resultado.="<th>";
                $resultado.="<div class='header'>";
                $resultado.="<h6 class='title'>Nenhum Registro Encontrado</h6>";
                $resultado.="</div>";
                $resultado.="</th>";
                $resultado.="</tr>";
            }

        $resultado .="</tbody>";
        $resultado .="</table>";

        echo $resultado;
    }

    public function show($id) {
        $livro = Livro::findOrFail($id);
        $status = Status::all();
        $user = Auth::id();
        
        if (Auth::check()) {
            $is_admin = Auth::user()->is_admin;
        } else {
            return redirect('/')->with('msg-erro', 'Faça login para continuar.');
        }

        // Busca por livro na estante do usuário
        $is_estante_user = DB::select("SELECT
                                            l.id as livro_id
                                        FROM users_livro as u
                                        INNER JOIN livro as l ON u.fk_livro_id = l.id 
                                        WHERE u.user_id = $user AND l.id = $id");
        
        // Pegando quantidade de itens no array
        $is_estante_user = count($is_estante_user);

        //dd(count($is_estante_user));

        return view('livros.show', compact('livro', 'status', 'user', 'is_admin', 'is_estante_user'));
    }

    public function livros() {
        $is_admin = Auth::user()->is_admin;

        $search = request('search');

        if ($search) {

            $livros = Livro::where([
                ['titulo', 'like', '%'.$search.'%']
            ])->get();

        } else {
            $livros = DB::select("SELECT l.id, l.titulo, l.ano, a.nome FROM livro as l INNER JOIN autor as a ON l.fk_autor_id = a.id;");
        }
        
        return view('livros', compact('livros', 'is_admin', 'search'));
    }

    public function create() {
        $autores = Autor::all();
        $assuntos = Assunto::all();
        $editoras = Editora::all();
        $is_admin = Auth::user()->is_admin;

        return view('livros.create', compact('autores', 'assuntos', 'editoras', 'is_admin'));
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

        return redirect('/livros')->with('msg', 'Imagem de capa removida com sucesso.');
    }

    // 
    public function edit($id) {
        $livro = Livro::findOrFail($id);
        $autores = Autor::all();
        $assuntos = Assunto::all();
        $editoras = Editora::all();
        $is_admin = Auth::user()->is_admin;
        
        //dd($livro->relCapaLivro);

        return view('livros.edit', compact('livro', 'autores', 'assuntos', 'editoras', 'is_admin'));
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
