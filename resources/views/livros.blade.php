@extends('layouts.main')

@section('title', 'Livros - Admin')

@section('content')

    <div class="center">
        <!-- div busca -->
        <div id="search-container" class="col-md-12 busca">
            <h1>Livros</h1>
            <div class="right">
                <a href="/livros/create">
                    <button data-toggle="tooltip" data-placement="top" title="Novo título" class="btn-livros novo-livro">
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
        <div id="livros-container" class="col-md-12">
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
                    <td>FAZER JOIN AUTOR</td>
                    <td>{{ $livro->ano }}</td>
                    <td>
                        <button class="btn-livros" data-toggle="tooltip" data-placement="top" title="Editar">
                            <i class="fas fa-pencil-alt"></i>
                        </button>    
                        <button class="btn-livros" data-toggle="tooltip" data-placement="top" title="Excluir">
                            <i class="fas fa-trash-alt"></i>
                        </button>


                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
        
@endsection