@extends('layouts.main')

@section('title', 'MyShelf')

@section('content')

<div class="center">
    <div id="search-container" class="col-md-12">
        <h1>Busque por um título</h1>
        <form action="">
            <input type="text" id="search" name="search" class="form-control" placeholder="Buscar">
        </form>
    </div>
        
    <div id="livros-container" class="col-md-12">
        <div class="row">
            @foreach ($livros as $livro)
            <div class="card col-md-3">
                <img src="/img/capa_placeholder.jpg" alt="{{ $livro->title }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $livro->titulo }}</h5>
                    <a href="#" class="btn">Detalhes</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection