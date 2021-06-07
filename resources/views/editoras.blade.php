@extends('layouts.main')

@section('title', 'Editoras - Admin')

@section('content')

    <div class="center">
        <h1>Editoras</h1>
        <!-- div busca -->
        <!-- <div id="search-container" class="col-md-12 busca">
            @if ($search)
            <h1>Buscando por: {{ $search }}</h1>    
            @else
            @endif
            <div class="clear"></div>
            <form action="/editoras" method="GET" >
            <input type="text" id="search_editora" name="search-editora" class="form-control form-search" placeholder="Busque por uma editora">
            <input type="submit" class="btn-search" value="Pesquisar">
            <div class="clear"></div>
        </form>
    </div> -->
        <div class="right">
            <a href="/editoras/create">
                <button data-toggle="tooltip" data-placement="top" title="Nova editora" class="btn-livros novo-livro">
                    <i class="fas fa-plus-circle"></i>
                </button>
            </a>
        </div>

        <!-- div tabela -->
        <div id="livros-container" class="col-md-12" style="padding: 0;">
        <table class="table table-livros" id="data-table-editoras">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Editora</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($editoras as $editora)

                <tr>
                    <td>{{ $editora->id }}</td>
                    <td>{{ $editora->nome }}</td>
                    <td>
                        <!-- botão editar -->
                        <a href="/editoras/edit/{{ $editora->id }}" style="text-decoration: none;">
                            <button class="btn-livros" data-toggle="tooltip" data-placement="top" title="Editar">
                                <i class="fas fa-pencil-alt"></i>
                            </button>    
                        </a>

                        <!-- form e botão excluir -->
                        <form action="/editoras/{{ $editora->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn-livros" data-toggle="tooltip" data-placement="top" title="Excluir">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @if (count($editoras) == 0 && $search)
                    <p>Não encontramos nenhuma editora com "{{ $search }}". <a href="/editoras">Ver todas.</a></p>
                @elseif (count($editoras) == 0)
                    <p>Não há editoras disponíveis.</p>
                @endif
            </tbody>
        </table>
    </div>
</div>
        
@endsection