<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserLivro;
use App\Models\Status;
use App\Models\Livro;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

class UserLivroController extends Controller
{
    public function estante() {
        $search = request('search');
        $user = Auth::user();
        $user_id = Auth::id();
        $is_admin = Auth::user()->is_admin;
        $status = Status::all();
        
        //$livros = UserLivro::all();
        
        // if ($search) {
            
            //     // Fazer JOIN com Livro pelo id do livro e fk_livro_id
            //     $livros = UserLivro::where([
                //         ['titulo', 'like', '%'.$search.'%']
                //     ])->get();
                
                // } else {
                    //     $livros = Livro::all();
                    // }
                    
                    $livros = DB::select("SELECT 
                                            l.id, 
                                            l.titulo, 
                                            u.id as users_livro_id, 
                                            u.user_id, 
                                            u.fk_status_id, 
                                            u.fk_livro_id,
                                            s.id as status_id,
                                            s.nome as status,
                                            c.nome
                                         FROM users_livro as u
                                         LEFT JOIN livro as l ON u.fk_livro_id = l.id
                                         LEFT JOIN status as s ON u.fk_status_id = s.id
                                         LEFT JOIN capa_livro as c ON l.id = c.fk_livro_id
                                         WHERE u.user_id = $user_id");
                    
                    $count_livros = count($livros);

        $user_livro = new UserLivro;
        //dd($user_livro);

        //dd($count_livros);
        
        return view('estante', compact('livros', 'search', 'user', 'is_admin', 'status', 'user_livro', 'count_livros'));
    }

    public function adicionaLivro(Request $request) {
        $user_livro = new UserLivro;
        $livro = Livro::findOrFail($request->livro_id);
        $user = Auth::id();
        $count_livro = UserLivro::where('user_id', $user)->where('fk_livro_id', $request->livro_id)->count();
        //dd($count_livro);

        if ($count_livro != 0) {
            return redirect('/catalogo')->with('msg-warning', 'O livro já está na sua estante!');
        } else {
            $user_livro->user_id = $user;
            $user_livro->fk_status_id = $request->status;
            $user_livro->fk_livro_id = $livro->id;
    
            $user_livro->save();
        }

        return redirect('/estante')->with('msg', 'Livro adicionado à estante!');
    }

    public function show($id) {
        $livro = Livro::findOrFail($id);
        $status = Status::all();
        $user = Auth::user();
        $user_id = Auth::id();
        $is_admin = Auth::user()->is_admin;

        $user_livro = DB::select("SELECT 
                                    u.id as users_livro_id, 
                                    u.user_id, 
                                    u.fk_status_id, 
                                    u.fk_livro_id,
                                    s.id as status_id,
                                    s.nome as status
                                 FROM users_livro as u
                                 INNER JOIN status as s ON u.fk_status_id = s.id
                                 WHERE u.user_id = $user_id");

        return view('/estante-detalhe', compact('livro', 'status', 'user', 'user_id', 'is_admin', 'user_livro'));
    }

    public function pesquisaStatus($id) {
        
        $user_id = Auth::id();
        $livro = Livro::where('id', $id)->first();
        
        $livros = DB::select("SELECT 
                                            l.id, 
                                            l.titulo, 
                                            u.id as users_livro_id, 
                                            u.user_id, 
                                            u.fk_status_id, 
                                            u.fk_livro_id,
                                            s.id as status_id,
                                            s.nome as status,
                                            c.nome
                                         FROM users_livro as u
                                         LEFT JOIN livro as l ON u.fk_livro_id = l.id
                                         LEFT JOIN status as s ON u.fk_status_id = s.id
                                         LEFT JOIN capa_livro as c ON l.id = c.fk_livro_id
                                         WHERE u.user_id = $user_id and l.id = $id");

        return $livros;
    }

    public function atualizaStatus(Request $request) {
        //dd($request->user_livro_id);

        UserLivro::where(['id' => $request->user_livro_id])->update([
            'fk_status_id' => $request->status,
        ]);

        return redirect('/estante')->with('msg', 'Status atualizado com sucesso.');
    }

    public function removeLivro(Request $request) {
        //dd($request);
        UserLivro::findOrFail($request->users_livro_id)->delete();

        return redirect('/estante')->with('msg', 'Livro excluído com sucesso!');
    }
}
