@extends('layouts.main')

@section('title', 'MyShelf')

@section('content')

<div class="center div-estante">
    
    <h1 style="margin-top: 30px;">Estante de {{ $user->name }}</h1>
    
    @if ($count_livros == 0)
    <h6>Sua estante ainda está vazia :(</h6>
    <p>Adicione livros à sua estante <a href="/catalogo">aqui</a>.</p>
    @else
    <div id="livros-container" class="col-md-12">
        <div class="row">
            @foreach ($livros as $livro)
            <div class="card col-md-3 card-livro">
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

                
                <div class="card-body" style="padding: 0; width: 100%;">

                    <div style="width: 100%;">
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        @if ($livro->status == 'Lido')
                        <a class="link-status" id="pesquisarStatus" data-href="{{ route('pesquisar', $livro->id) }}">
                            <div class="tag-status" id="tag-lido" style="background-color: green;">
                                <span style="color:white;">
                                    <i class="fas fa-book"></i>
                                    Lido
                                </span>
                            </div>
                        </a>
                        @elseif ($livro->status == 'Lendo')
                        <a class="link-status" id="pesquisarStatus" data-href="{{ route('pesquisar', $livro->id) }}">
                            <div class="tag-status" id="tag-lendo" style="background-color: yellow;">
                                <span style="color:black;">
                                    <i class="fas fa-book"></i>
                                    Lendo
                                </span> 
                            </div>
                        </a>
                        @else
                        <a class="link-status" id="pesquisarStatus" data-href="{{ route('pesquisar', $livro->id) }}">
                            <div class="tag-status" id="tag-ler" style="background-color: red;">
                                <span style="color:white;">
                                    <i class="fas fa-book"></i>
                                    Quero ler
                                </span> 
                            </div>
                        </a>
                        @endif
                        <button data-href="{{ $livro->users_livro_id }}" class="btn btn-danger hide btn-exclusao-estante" data-toggle="tooltip" data-placement="top" title="Excluir livro">
                            <i class="fas fa-trash-alt" style="font-size: 15px !important;"></i>
                        </button>
                    </div>
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
    @endif


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
                    
                    <form action="{{ route('atualizar') }}" method="POST">
                        @csrf
                        <input type="hidden" id="user_livro_id" name="user_livro_id">
                        <div class="form-group">    
                            <label for="autor">Status</label>
                            <select class="form-control" name="status" id="status" required>
                                <!-- option dinâmica trazida pelo JavaScript -->
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

     <!-- Modal excluir livro da estante -->
     <div class="modal fade" id="modalExclusaoEstante" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Excluir livro da estante</h5>
                    <button id="btn-close-est-01" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body">
                    Deseja excluir o livro da estante?
                    <!-- Inicio form -->
                    
                    <form action="{{ route('removerDaEstante') }}" method="POST">
                        @csrf
                        <input type="hidden" name="users_livro_id" id="deleteId">
                        <div>
                            <button id="btn-close-est-02" type="button" class="btn btn-success" data-bs-dismiss="modal">Não</button>
                            <button type="submit" class="btn btn-danger">Sim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>  

@endsection