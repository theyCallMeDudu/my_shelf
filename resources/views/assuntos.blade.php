@extends('layouts.main')

@section('title', 'Assuntos - Admin')

@section('content')

    <div class="center">
        <!-- div busca -->
        <div id="search-container" class="col-md-12 busca">
            @if ($search)
            <h1>Buscando por: {{ $search }}</h1>    
            @else
            <h1>Assuntos</h1>
            @endif
            <div class="right">
                <a href="/assuntos/create">
                    <button data-toggle="tooltip" data-placement="top" title="Novo assunto" class="btn-livros novo-livro">
                        <i class="fas fa-plus-circle"></i>
                    </button>
                </a>
            </div>
            <div class="clear"></div>
            <form action="/assuntos" method="GET" >
                <input type="text" id="search_assunto" name="search-assunto" class="form-control form-search" placeholder="Busque por um assunto">
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
                    <th scope="col">Assunto</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($assuntos as $assunto)

                <tr>
                    <td>{{ $assunto->id }}</td>
                    <td>{{ $assunto->nome }}</td>
                    <td>
                        <!-- botão editar -->
                        <a href="/assuntos/edit/{{ $assunto->id }}" style="text-decoration: none;">
                            <button class="btn-livros" data-toggle="tooltip" data-placement="top" title="Editar">
                                <i class="fas fa-pencil-alt"></i>
                            </button>    
                        </a>

                        <!-- form e botão excluir -->
                        <form action="/assuntos/{{ $assunto->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn-livros" data-toggle="tooltip" data-placement="top" title="Excluir">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>


                    </td>
                </tr>
                @endforeach
                @if (count($assuntos) == 0 && $search)
                    <p>Não encontramos nenhum assunto com "{{ $search }}". <a href="/assuntos">Ver todos.</a></p>
                @elseif (count($assuntos) == 0)
                    <p>Não há assuntos disponíveis.</p>
                @endif
            </tbody>
        </table>
    </div>
</div>
        
@endsection