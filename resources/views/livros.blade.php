@extends('layouts.main')

@section('title', 'Livros - Admin')

@section('content')

    <div class="center">
        <!-- div busca -->
        <div id="search-container" class="col-md-12 busca">
            @if ($search)
            <h1>Buscando por: {{ $search }}</h1>    
            @else
            <h1>Livros</h1>
            @endif
            <div class="right">
                <a href="/livros/create">
                    <button data-toggle="tooltip" data-placement="top" title="Novo título" class="btn-livros novo-livro">
                        <i class="fas fa-plus-circle"></i>
                    </button>
                </a>
            </div>
            <div class="clear"></div>
            <form action="/livros" method="GET" >
                <input type="text" id="search" name="search" class="form-control form-search" placeholder="Busque por um título">
                <input type="submit" class="btn-search" value="Pesquisar">
                <div class="clear"></div>
            </form>
        </div>

        <!-- div tabela -->
        <div id="livros-container" class="col-md-12" style="padding: 0;">
        <table class="table table-livros">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Título</th>
                    <th scope="col">Autor</th>
                    <th scope="col">Ano</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($livros as $livro)

                <tr>
                    <td>{{ $livro->id }}</td>
                    <td>{{ $livro->titulo }}</td>
                    <td>{{ $livro->nome }}</td>
                    <td>{{ $livro->ano }}</td>
                    <td>
                        <!-- botão editar -->
                        <a href="/livros/edit/{{ $livro->id }}" style="text-decoration: none;">
                            <button class="btn-livros" data-toggle="tooltip" data-placement="top" title="Editar">
                                <i class="fas fa-pencil-alt"></i>
                            </button>    
                        </a>

                        <!-- form e botão excluir -->
                        <form action="/livros/{{ $livro->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn-livros" data-toggle="tooltip" data-placement="top" title="Excluir">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @if (count($livros) == 0 && $search)
                    <p>Não encontramos nenhum título com "{{ $search }}". <a href="/livros">Ver todos.</a></p>
                @elseif (count($livros) == 0)
                    <p>Não há livros disponíveis.</p>
                @endif
            </tbody>
        </table>
    </div>
</div>
        
@endsection