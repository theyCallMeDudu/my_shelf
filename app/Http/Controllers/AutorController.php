<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Autor;

class AutorController extends Controller
{
    public function autores() {
        $autores = Autor::all();
        //dd($livros);
        
        //return view('livros', ['livros' => $livros]);
        return view('autores', compact('autores'));
    }

    public function create() {
        return view('autores.create');
    }

    public function store(Request $request) {
        $autor = new Autor;

        $autor->nome = $request->nome;

        $autor->save();

        return redirect('/autores');
    }

    public function edit($id) {
        $autor = Autor::findOrFail($id);

        return view('autores.edit', compact('autor'));
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
