@extends('layouts.main')

@section('title', $livro->titulo)

@section('content')

    <div class="center div-detalhe-livro">
        <div class="row">
            <div id="capa-container" class="col-md-6">
                <img src="/img/capas/{{ $livro->image }}" class="capa-detalhe" alt="Título do livro: {{ $livro->titulo }}">
            </div>
            <div id="info-container" class="col-md-6">
                <h1>{{ $livro->titulo }}</h1>
                <p>Autor: {{ $livro->relAutor->nome }}</p>
                <p>Ano: {{ $livro->ano }}</p>
                <p>Páginas: {{ $livro->paginas }}</p>
                <p>Assunto: {{ $livro->relAssunto->nome }}</p>
                <div>
                    <p style="display: inline;">Status:</p>
                    <i class="fas fa-book lido"></i><i class="fas fa-book lendo"></i><i class="fas fa-book quero-ler"></i>
                </div>
            </div>
        </div>
    </div>

@endsection