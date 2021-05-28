@extends('layouts.main')

@section('title', $livro->titulo.' de '.$user->name)

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
                
                <div>
                    <button id="btn-modal-troca-status" class="btn btn-success">
                        <i class="fas fa-flag"></i>
                        Atualizar status
                    </button>
                </div>
                

                <!-- Modal trocar status -->
                <div class="modal fade" id="modalTrocaStatus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <!-- Se autenticado, poderá adicionar à estante -->
                                
                                
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
                                </div>
                                <div class="modal-footer">
                                    <button id="btn-close-04" type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                </div>

                                    </form>
                                    <!-- Fim form -->
                        </div>
                    </div>
                    
                    
            </div>
        </div>
    </div>

@endsection