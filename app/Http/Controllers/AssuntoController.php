<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assunto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AssuntoController extends Controller
{
    public function assuntos() {
        $is_admin = Auth::user()->is_admin;

        $search = request('search-assunto');

        if ($search) {

            $assuntos = Assunto::where([
                ['nome', 'like', '%'.$search.'%']
            ])->get();

        } else {
            $assuntos = Assunto::all();
        }

        return view('assuntos', compact('is_admin', 'assuntos', 'search'));
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
