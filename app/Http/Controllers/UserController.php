<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function usuarios() {
        $users = User::all();
        $is_admin = Auth::id();

        return view('admin.gestao', compact('users', 'is_admin'));
    }

    public function minhaConta() {
        $user = Auth::user();
        $user_id = Auth::id();
        $is_admin = $user_id;
        $status = Status::all();

        $livros = '';
        // $livros = DB::select("SELECT 
        //                         l.id, 
        //                         l.titulo, 
        //                         u.id as users_livro_id, 
        //                         u.user_id, 
        //                         u.fk_status_id, 
        //                         u.fk_livro_id,
        //                         s.id as status_id,
        //                         s.nome as status,
        //                         c.nome
        //                      FROM users_livro as u
        //                      LEFT JOIN livro as l ON u.fk_livro_id = l.id
        //                      LEFT JOIN status as s ON u.fk_status_id = s.id
        //                      LEFT JOIN capa_livro as c ON l.id = c.fk_livro_id
        //                      WHERE u.user_id = $user_id");
        
        return view('minha-conta', compact('user', 'is_admin', 'status', 'livros'));
    }
}
