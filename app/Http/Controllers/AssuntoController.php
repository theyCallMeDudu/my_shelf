<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assunto;
use Illuminate\Support\Facades\Auth;

class AssuntoController extends Controller
{
    public function assuntos() {
        $assuntos = Assunto::all();
        $is_admin = Auth::user()->is_admin;

        return view('assuntos', compact('assuntos', 'is_admin'));
    }

    public function create() {
        $is_admin = Auth::user()->is_admin;

        return view('assuntos.create', compact('is_admin'));
    }

    public function store(Request $request) {
        $assunto = new Assunto;

        $assunto->nome = $request->nome;

        $assunto->save();

        return redirect('/assuntos');
    }

    public function edit($id) {
        $assunto = Assunto::findOrFail($id);
        $is_admin = Auth::user()->is_admin;

        return view('assuntos.edit', compact('assunto', 'is_admin'));
    }

    public function update(Request $request) {

        $data = $request->all();

        Assunto::findOrFail($request->id)->update($data);

        return redirect('/assuntos')->with('msg', 'Assunto editado com sucesso!');

    }

    public function destroy($id) {
        Assunto::findOrFail($id)->delete();

        return redirect('/assuntos')->with('msg', 'Assunto excluído com sucesso!');
    }
}
