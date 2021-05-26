<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserLivro;
use App\Models\Status;
use App\Models\Livro;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserLivroController extends Controller
{
    public function store(Request $request, $id) {
        $user_livro = new UserLivro;
        $livro = Livro::findOrFail($id);
        $user = Auth::id();

        $user_livro->user_id = $user;
        $user_livro->fk_status_id = $request->status;
        $user_livro->fk_livro_id = $livro;

        $user_livro->save();

        return redirect('/estante')->with('msg', 'Livro adicionado à estante!');
    }
}
