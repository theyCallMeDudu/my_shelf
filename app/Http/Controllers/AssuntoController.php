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
}
