<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Editora;

class EditoraController extends Controller
{
    public function editoras() {
        $editoras = Editora::all();

        return view('editoras', compact('editoras'));
    }

    public function create() {
        return view('editoras.create');
    }

    public function store(Request $request) {
        $editora = new Editora;

        $editora->nome = $request->nome;

        $editora->save();

        return redirect('/editoras');
    }
}
