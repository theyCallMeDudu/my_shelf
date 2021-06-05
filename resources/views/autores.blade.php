@extends('layouts.main')

@section('title', 'Autores - Admin')

@section('content')

    <div class="center">
        <!-- div busca -->
        <div id="search-container" class="col-md-12 busca">
            @if ($search)
            <h1>Buscando por: {{ $search }}</h1>    
            @else
            <h1>Autores</h1>
            @endif
            <div class="right">
                <a href="/autores/create">
                    <button data-toggle="tooltip" data-placement="top" title="Novo autor" class="btn-livros novo-livro">
                        <i class="fas fa-plus-circle"></i>
                    </button>
                </a>
            </div>
            <div class="clear"></div>
            <form action="/autores" method="GET" >
                <input type="text" id="search_autor" name="search-autor" class="form-control form-search" placeholder="Busque por um autor">
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
                    <th scope="col">Nome</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($autores as $autor)

                <tr>
                    <td>{{ $autor->id }}</td>
                    <td>{{ $autor->nome }}</td>
                    <td>
                        <!-- botão editar -->
                        <a href="/autores/edit/{{ $autor->id }}" style="text-decoration: none;">
                            <button class="btn-livros" data-toggle="tooltip" data-placement="top" title="Editar">
                                <i class="fas fa-pencil-alt"></i>
                            </button>    
                        </a>

                        <!-- form e botão excluir -->
                        <form action="/autores/{{ $autor->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn-livros" data-toggle="tooltip" data-placement="top" title="Excluir">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @if (count($autores) == 0 && $search)
                    <p>Não encontramos nenhum autor com "{{ $search }}". <a href="/autores">Ver todos.</a></p>
                @elseif (count($autores) == 0)
                    <p>Não há autores disponíveis.</p>
                @endif
            </tbody>
        </table>
    </div>
</div>
        
@endsection