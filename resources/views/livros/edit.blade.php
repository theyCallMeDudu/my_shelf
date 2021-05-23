@extends('layouts.main')

@section('title', 'Editando: ' . $livro->titulo)

@section('content')

    <div class="center">
        <h1>Editando: {{ $livro->titulo }}</h1>

        <div id="livro-create-container" class="col-md-6-offset-md-3">
            <form action="/livros/update/{{ $livro->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="titulo">Título</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título do livro" value="{{ $livro->titulo }}" required autocomplete="off">
                </div>

                <div class="form-group">
                    <label for="ano">Ano</label>
                    <input type="number" class="form-control" id="ano" name="ano" placeholder="ex: 1900" value="{{ $livro->ano }}" max="9999">
                </div>

                <div class="form-group">
                    <label for="paginas">Páginas</label>
                    <input type="number" class="form-control" id="paginas" name="paginas" placeholder="ex: 411" value="{{ $livro->paginas }}">
                </div>

                <div class="form-group">    
                <label for="autor">Autor</label>
                    <select class="form-control" name="autor" id="autor" required>
                        <option value="{{$livro->relAutor->id ?? ''}}">{{$livro->relAutor->nome ?? 'Selecione'}}</option>
                        @foreach($autores as $autor)
                        <option value="{{$autor->id}}">{{$autor->nome}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">   
                <label for="assunto">Assunto</label> 
                    <select class="form-control" name="assunto" id="assunto" required>
                        <option value="{{$livro->relAssunto->id ?? ''}}">{{$livro->relAssunto->nome ?? 'Selecione'}}</option>
                        @foreach($assuntos as $assunto)
                        <option value="{{$assunto->id}}">{{$assunto->nome}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">   
                <label for="editora">Editora</label> 
                    <select class="form-control" name="editora" id="editora">
                        <option value="{{$livro->relEditora->id ?? ''}}">{{$livro->relEditora->nome ?? 'Selecione'}}</option>
                        @foreach($editoras as $editora)
                        <option value="{{$editora->id}}">{{$editora->nome}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="image">Capa</label>
                    <input type="file" id="image" name="image" class="form-control-file">
                    <img src="{{ asset('storage/' . $livro->relCapaLivro->nome) }}" alt="Título do livro: {{ $livro->titulo }}" class="img-preview">        
                </div>
                
                <div class="div-btn-cad" style="float: left;">
                    <input type="submit" class="btn btn-success" value="Salvar alterações">
                </div>
            </form>

            <form action="{{ route('remover') }}" method="POST">
                @csrf
                <input type="hidden" name="imagemCapa" value="{{ $livro->relCapaLivro->nome }}">
                <button type="submit" class="btn btn-danger" style="display: inline-block; margin: 10px;" data-toggle="tooltip" data-placement="top" title="Remover imagem">
                    <i class="fas fa-trash"></i>
                </button>
            </form>

        </div>
    </div>

@endsection