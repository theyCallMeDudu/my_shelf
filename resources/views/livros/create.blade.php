@extends('layouts.main')

@section('title', 'Cadastro')

@section('content')

    <div class="center">
        <h1>Novo título</h1>

        <div id="livro-create-container" class="col-md-6-offset-md-3">
            <form action="/livros" method="POST">
                @csrf
                <div class="form-group">
                    <label for="titulo">Título</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título do livro" required autocomplete="off">
                </div>

                <div class="form-group">
                    <label for="ano">Ano</label>
                    <input type="number" class="form-control" id="ano" name="ano" placeholder="ex: 1900">
                </div>

                <div class="form-group">
                    <label for="paginas">Páginas</label>
                    <input type="number" class="form-control" id="paginas" name="paginas" placeholder="ex: 411">
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

                <div class="div-btn-cad">
                    <input type="submit" class="btn btn-success" value="Cadastrar">
                </div>
            </form>
        </div>
    </div>

@endsection