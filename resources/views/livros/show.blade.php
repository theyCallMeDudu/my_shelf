@extends('layouts.main')

@section('title', $livro->titulo)

@section('content')

    <div class="center div-detalhe-livro">
        <div class="row">
            <div id="capa-container" class="col-md-6">
                @if (isset($livro->relCapaLivro->nome))
                <img class="capa-livro" src="{{ asset('storage/' . $livro->relCapaLivro->nome)  }}" alt="{{ $livro->titulo }}">
                @else
                <img class="capa-livro" src="/img/sem_capa.png" alt="{{ $livro->titulo }}">
                @endif
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