@extends('layouts.main')

@section('title', 'Cadastro - assunto')

@section('content')

    <div class="center">
        <h1>Novo assunto</h1>

        <div id="livro-create-container" class="col-md-6-offset-md-3">
            <form action="/assuntos" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="ex: Romance" required autocomplete="off">
                </div>

                <div class="div-btn-cad">
                    <input type="submit" class="btn btn-success" value="Cadastrar">
                </div>
            </form>
        </div>
    </div>

@endsection