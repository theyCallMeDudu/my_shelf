@extends('layouts.main')

@section('title', 'MyShelf')

@section('content')

<div class="center">
    <div id="search-container" class="col-md-12 busca">
        @if ($search)
        <h1>Buscando por: "{{ $search }}".</h1>
        @else
        <h1>Estante de {{ $user->name }}</h1>
        @endif
        <form action="/estante" method="GET">
            <input type="text" id="search" name="search" class="form-control" placeholder="Busque por um título">
        </form>
    </div>
        
    <div id="livros-container" class="col-md-12">
        <div class="row">
            @foreach ($livros as $livro)
            <div class="card col-md-3">
                <!-- @if (isset($livro->relCapaLivro->nome))
                <img class="capa-livro" src="{{ asset('storage/' . $livro->relCapaLivro->nome)  }}" alt="{{ $livro->titulo }}">
                @else
                <img class="capa-livro" src="/img/sem_capa.png" alt="{{ $livro->titulo }}">
            </div>
                @endif -->
                @if (isset($livro->nome))
                <img class="capa-livro" src="{{ asset('storage/' . $livro->nome)  }}" alt="{{ $livro->titulo }}">
                @else
                <img class="capa-livro" src="/img/sem_capa.png" alt="{{ $livro->titulo }}">
                @endif

                <h6 class="card-title titulo-livro-estante">{{ $livro->titulo }}</h6>
                
                <div class="card-body" style="padding: 0;">

                    @if ($livro->status == 'Lido')
                    <div id="tag-lido" style="background-color: green;">
                        <span style="color:white;">
                            <i class="fas fa-book"></i>
                            Lido
                        </span> 
                    </div>
                    @elseif ($livro->status == 'Lendo')
                    <div id="tag-lendo" style="background-color: yellow;">
                        <span style="color:black;">
                            <i class="fas fa-book"></i>
                            Lendo
                        </span> 
                    </div>
                    @else
                    <div id="tag-ler" style="background-color: red;">
                        <span style="color:white;">
                            <i class="fas fa-book"></i>
                            Quero ler
                        </span> 
                    </div>
                    @endif
                </div>
                <a class="card-detalhe" href="/livros/{{ $livro->id }}">Detalhes</a>
                
            </div>
            @endforeach
            @if (count($livros) == 0 && $search)
            <p>Não foi possível encontrar nenhum livro com "{{ $search }}". <a href="/estante">Ver todos</a> </p>
            @elseif (count($livros) == 0)
            <p>Sua estante está vazia :(</p>
            @endif
        </div>
    </div>
@endsection