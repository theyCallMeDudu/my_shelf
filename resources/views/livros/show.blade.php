@extends('layouts.main')

@section('title', $livro->titulo)

@section('content')

    <div class="center div-detalhe-livro">
        <div class="row">
            <div id="capa-container" class="col-md-6">
                @if (isset($livro->relCapaLivro->nome))
                <img class="capa-livro-detalhe" src="{{ asset('storage/' . $livro->relCapaLivro->nome)  }}" alt="{{ $livro->titulo }}">
                @else
                <img class="capa-livro-detalhe" src="/img/sem_capa.png" alt="{{ $livro->titulo }}">
                @endif
            </div>
            <div id="info-container" class="col-md-6">
                <h1>{{ $livro->titulo }}</h1>
                <p>Autor: {{ $livro->relAutor->nome }}</p>
                <p>Ano: {{ $livro->ano }}</p>
                <p>Páginas: {{ $livro->paginas }}</p>
                <p>Assunto: {{ $livro->relAssunto->nome }}</p>
            
                    @if ($is_estante_user > 0)
                    <div>
                        <p style="display: inline; margin-right: 10px;">Este livro já está na sua estante</p><i class="fas fa-check-circle"></i>
                    </div>
                    @else
                    <div>
                        <button id="btn-modal-add-livro" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddLivro">
                            <i class="fas fa-plus"></i>
                            Adicionar à estante
                        </button>
                    </div>
                    @endif
                
                

                <!-- Modal adicionar à estante -->
                    <div class="modal fade" id="modalAddLivro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <!-- Se autenticado, poderá adicionar à estante -->
                                
                                
                                    @if (isset($user))
                                    <h5 class="modal-title" id="exampleModalLabel">Adicionar livro à estante</h5>
                                    <button id="btn-close-02" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    Selecione um status
                                    <form action="{{ route('adicionar') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="livro_id" value="{{ $livro->id }}">
                                    <div class="form-group">    
                                        <label for="status">Status</label>
                                        <select class="form-control" name="status" id="status" required>
                                            @foreach($status as $st)
                                            
                                            @if ($st->id == 1)
                                            <option value="{{ $st->id }}" style="color: green; font-weight:700;">{{ $st->nome }}</option>
                                            @elseif ($st->id == 2)
                                                <option value="{{ $st->id }}" style="color: yellow; font-weight:700;">{{ $st->nome }}</option>
                                                @else
                                                <option value="{{ $st->id }}" style="color: red; font-weight:700;">{{ $st->nome }}</option>
                                                @endif
                                                
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button id="btn-close-01" type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                </div>
                            </form>

                                @else
                                <h5 class="modal-title" id="exampleModalLabel">Adicionar livro à estante</h5>
                                <button id="btn-close-02" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body text-center">
                                <p style="margin-bottom: 20px;">Faça login para adicionar o título à sua estante.</p>
                                    <div>
                                        <a href="/login">    
                                        <button class="btn btn-primary">
                                            Ir para página de Login
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection