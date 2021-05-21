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

    public function edit($id) {
        $editora = Editora::findOrFail($id);

        return view('editoras.edit', compact('editora'));
    }

    public function update(Request $request) {
        $data = $request->all();

        Editora::findOrFail($request->id)->update($data);

        return redirect('/editoras')->with('msg', 'Editora editada com sucesso!');
    }

    public function destroy($id) {
        Editora::findOrFail($id)->delete();

        return redirect('/editoras')->with('msg', 'Editora excluída com sucesso!');
    }
}
