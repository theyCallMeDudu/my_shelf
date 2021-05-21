@extends('layouts.main')

@section('title', 'Editando: ' . $editora->nome)

@section('content')

    <div class="center">
        <h1>Editando: {{ $editora->nome }}</h1>

        <div id="livro-create-container" class="col-md-6-offset-md-3">
            <form action="/editoras/update/{{ $editora->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="ex: Romance" required autocomplete="off" value="{{ $editora->nome }}">
                </div>

                <div class="div-btn-cad">
                    <input type="submit" class="btn btn-success" value="Salvar alterações">
                </div>
            </form>
        </div>
    </div>

@endsection