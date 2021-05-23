@extends('layouts.main')

@section('title', 'Assuntos - Admin')

@section('content')

    <div class="center">
        <!-- div busca -->
        <div id="search-container" class="col-md-12 busca">
            <h1>Assuntos</h1>
            <div class="right">
                <a href="/assuntos/create">
                    <button data-toggle="tooltip" data-placement="top" title="Novo assunto" class="btn-livros novo-livro">
                        <i class="fas fa-plus-circle"></i>
                    </button>
                </a>
            </div>
            <div class="clear"></div>
            <form action="">
                <input type="text" id="search" name="search" class="form-control" placeholder="Buscar">
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
            </tbody>
        </table>
    </div>
</div>
        
@endsection