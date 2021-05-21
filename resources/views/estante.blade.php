@extends('layouts.main')

@section('title', 'MyShelf')

@section('content')

<div class="center">
    <div id="search-container" class="col-md-12 busca">
        @if ($search)
        <h1>Buscando por: "{{ $search }}".</h1>
        @else
        <h1>Estante</h1>
        @endif
        <form action="/estante" method="GET">
            <input type="text" id="search" name="search" class="form-control" placeholder="Busque por um título">
        </form>
    </div>
        
    <div id="livros-container" class="col-md-12">
        <div class="row">
            @foreach ($livros as $livro)
            <div class="card col-md-3">
                <img class="capa-livro" src="/img/capas/{{ $livro->image }}" alt="{{ $livro->titulo }}">
                <div class="card-body">
                    <h6 class="card-title">{{ $livro->titulo }}</h6>
                    <a href="/livros/{{ $livro->id }}">Detalhes</a>
                </div>
            </div>
            @endforeach
            @if (count($livros) == 0 && $search)
            <p>Não foi possível encontrar nenhum livro com "{{ $search }}". <a href="/estante">Ver todos</a> </p>
            @elseif (count($livros) == 0)
            <p>Sua estante está vazia :(</p>
            @endif
        </div>
    </div>
</div>
@endsection