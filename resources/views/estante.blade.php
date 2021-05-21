@extends('layouts.main')

@section('title', 'MyShelf')

@section('content')

<div class="center">
    <div id="search-container" class="col-md-12 busca">
        <h1>Estante</h1>
        <form action="">
            <input type="text" id="search" name="search" class="form-control" placeholder="Buscar">
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
        </div>
    </div>
</div>
@endsection