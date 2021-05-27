<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Editora;
use Illuminate\Support\Facades\Auth;

class EditoraController extends Controller
{
    public function editoras() {
        $editoras = Editora::all();
        $is_admin = Auth::user()->is_admin;

        return view('editoras', compact('editoras', 'is_admin'));
    }

    public function create() {
        $is_admin = Auth::user()->is_admin;

        return view('editoras.create', compact('is_admin'));
    }

    public function store(Request $request) {
        $editora = new Editora;

        $editora->nome = $request->nome;

        $editora->save();

        return redirect('/editoras');
    }

    public function edit($id) {
        $editora = Editora::findOrFail($id);
        $is_admin = Auth::user()->is_admin;

        return view('editoras.edit', compact('editora', 'is_admin'));
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
