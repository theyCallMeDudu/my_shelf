@extends('layouts.main')

@section('title', 'Catálogo')

@section('content')

<div class="center">
    <h1>Catálogo</h1>   

        {!! Form::open(['id' => 'pesquisaCatalogo']) !!}
            <div class="w50 pesquisa-esquerda">
                <div class="col-md6 inputs-esquerda">
                    <label for="autor">Autor</label>
                    <select name="autor" id="autor" class="form-control">
                        <option value="">Selecione</option>
                        @foreach ($autores as $autor)
                        <option value="{{ $autor->id }}">{{ $autor->nome }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md6 inputs-esquerda">
                    <label for="autor">Título</label>
                    <select name="titulo" id="titulo" class="form-control">
                        <option value="">Selecione</option>
                        @foreach ($livros as $livro)
                        <option value="{{ $livro->id }}">{{ $livro->titulo }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="pesquisa-direita">
                <div class="col-md6 inputs-direita">
                    <label for="autor">Assunto</label>
                    <select name="assunto" id="assunto" class="form-control">
                        <option value="">Selecione</option>
                        @foreach ($assuntos as $assunto)
                        <option value="{{ $assunto->id }}">{{ $assunto->nome }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md6 inputs-direita">
                    <label for="autor">Editora</label>
                    <select name="editora" id="editora" class="form-control">
                        <option value="">Selecione</option>
                        @foreach ($editoras as $editora)
                        <option value="{{ $editora->id }}">{{ $editora->nome }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Botão pesquisa -->
            <div class="form-group">
                <!-- <button type="submit" class="btn-pesquisa" id="btn-pesquisa" data-href="{{ route('pesquisaCatalogo') }}">Pesquisar</button> -->
                {{ Form::button('Pesquisar', ['class' => 'btn-pesquisa', 'id' => 'btn-pesquisa', 'data-href' => route('pesquisaCatalogo')]) }}
                <!-- {{ Form::reset('Limpar', ['class' => 'btn btn-marg-left btn-default', 'id' => 'btnLimpar']) }} -->
                <button type="reset" class="btn-pesquisa" id="btn-limpar">Limpar</button>
            </div>
        {!! Form::close() !!}
        <div class="clear"></div>
        
        <div id="carregar">
        </div>

        <div id="div-tabela-catalogo" style="margin-top: 30px;">
        </div>

</div>
@endsection