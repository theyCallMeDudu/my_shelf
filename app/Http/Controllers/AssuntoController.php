<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assunto;

class AssuntoController extends Controller
{
    public function assuntos() {
        $assuntos = Assunto::all();

        return view('assuntos', compact('assuntos'));
    }

    public function create() {
        return view('assuntos.create');
    }

    public function store(Request $request) {
        $assunto = new Assunto;

        $assunto->nome = $request->nome;

        $assunto->save();

        return redirect('/assuntos');
    }

    public function edit($id) {
        $assunto = Assunto::findOrFail($id);

        return view('assuntos.edit', compact('assunto'));
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
