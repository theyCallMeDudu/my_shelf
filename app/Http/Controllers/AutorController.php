<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Autor;
use Illuminate\Support\Facades\Auth;

class AutorController extends Controller
{
    public function autores() {
        $autores = Autor::all();
        $is_admin = Auth::user()->is_admin;
        //dd($livros);
        
        //return view('livros', ['livros' => $livros]);
        return view('autores', compact('autores', 'is_admin'));
    }

    public function create() {
        $is_admin = Auth::user()->is_admin;

        return view('autores.create', compact('is_admin'));
    }

    public function store(Request $request) {
        $autor = new Autor;

        $autor->nome = $request->nome;

        $autor->save();

        return redirect('/autores');
    }

    public function edit($id) {
        $autor = Autor::findOrFail($id);
        $is_admin = Auth::user()->is_admin;

        return view('autores.edit', compact('autor', 'is_admin'));
    }

    public function update(Request $request) {

        $data = $request->all();

        Autor::findOrFail($request->id)->update($data);

        return redirect('/autores')->with('msg', 'Autor editado com sucesso!');

    }

    public function destroy($id) {
        Autor::findOrFail($id)->delete();

        return redirect('/autores')->with('msg', 'Autor excluído com sucesso!');
    }
}
