<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserLivro;
use App\Models\Status;
use App\Models\Livro;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserLivroController extends Controller
{
    public function estante() {
        $search = request('search');
        $user = Auth::user();
        $user_id = Auth::id();
        $is_admin = Auth::user()->is_admin;

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
                                    s.nome as status,
                                    c.nome
                             FROM users_livro as u
                             LEFT JOIN livro as l ON u.fk_livro_id = l.id
                             LEFT JOIN status as s ON u.fk_status_id = s.id
                             LEFT JOIN capa_livro as c ON l.id = c.fk_livro_id
                             WHERE u.user_id = $user_id");
        //dd($livros);

        return view('estante', compact('livros', 'search', 'user', 'is_admin'));
    }

    public function adicionaLivro(Request $request) {
        $user_livro = new UserLivro;
        $livro = Livro::findOrFail($request->livro_id);
        $user = Auth::id();

        $user_livro->user_id = $user;
        $user_livro->fk_status_id = $request->status;
        $user_livro->fk_livro_id = $livro->id;

        $user_livro->save();

        return redirect('/estante')->with('msg', 'Livro adicionado à estante!');
    }

}
