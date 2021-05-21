@extends('layouts.main')

@section('title', 'Editando: ' . $autor->nome)

@section('content')

    <div class="center">
        <h1>Editando: {{ $autor->nome }}</h1>

        <div id="livro-create-container" class="col-md-6-offset-md-3">
            <form action="/autores/update/{{ $autor->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="ex: Romance" required autocomplete="off" value="{{ $autor->nome }}">
                </div>

                <div class="div-btn-cad">
                    <input type="submit" class="btn btn-success" value="Salvar alterações">
                </div>
            </form>
        </div>
    </div>

@endsection