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
                <h6 class="card-title titulo-livro-estante">{{ $livro->titulo }}</h6>

                @if (isset($livro->nome))
                <img class="capa-livro-estante" src="{{ asset('storage/' . $livro->nome)  }}" alt="{{ $livro->titulo }}">
                @else
                <img class="capa-livro-estante" src="/img/sem_capa.png" alt="{{ $livro->titulo }}">
                @endif

                
                <div class="card-body" style="padding: 0;">

                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    @if ($livro->status == 'Lido')
                    <a class="link-status" id="pesquisarStatus" data-href="{{ route('atualizar', $livro->id) }}">
                        <div class="tag-status" id="tag-lido" style="background-color: green;">
                            <span style="color:white;">
                                <i class="fas fa-book"></i>
                                Lido
                            </span>
                        </div>
                    </a>
                    @elseif ($livro->status == 'Lendo')
                    <a class="link-status" id="pesquisarStatus" data-href="{{ route('atualizar', $livro->id) }}">
                        <div class="tag-status" id="tag-lendo" style="background-color: yellow;">
                            <span style="color:black;">
                                <i class="fas fa-book"></i>
                                Lendo
                            </span> 
                        </div>
                    </a>
                    @else
                    <a class="link-status" id="pesquisarStatus" data-href="{{ route('atualizar', $livro->id) }}">
                        <div class="tag-status" id="tag-ler" style="background-color: red;">
                            <span style="color:white;">
                                <i class="fas fa-book"></i>
                                Quero ler
                            </span> 
                        </div>
                    </a>
                    @endif
                </div>
                <a class="card-detalhe" href="/estante-detalhe/{{ $livro->id }}">Detalhes</a>
            </div>
            @endforeach
            @if (count($livros) == 0 && $search)
            <p>Não foi possível encontrar nenhum livro com "{{ $search }}". <a href="/estante">Ver todos</a> </p>
            @elseif (count($livros) == 0)
            <p>Sua estante está vazia :(</p>
            @endif
        </div>
    </div>

    <!-- Modal trocar status -->
    <div class="modal fade" id="modalTrocaStatus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Atualizar status do livro</h5>
                    <button id="btn-close-03" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body">
                    Selecione um status
                    <!-- Inicio form -->
                    
                    <form action="" method="POST">
                        @csrf
                        <div class="form-group">    
                            <label for="autor">Status</label>
                            <select class="form-control" name="status" id="status" required>
                                <option value="{{ $livro->status_id }}">{{ $livro->status }}</option>
                                @foreach($status as $st)
                                <option value="{{ $st->id }}">{{ $st->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <button id="btn-close-04" type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>  

@endsection