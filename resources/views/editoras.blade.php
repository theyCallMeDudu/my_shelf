@extends('layouts.main')

@section('title', 'Editoras - Admin')

@section('content')

    <div class="center">
        <!-- div busca -->
        <div id="search-container" class="col-md-12 busca">
            <h1>Editoras</h1>
            <div class="right">
                <a href="/editoras/create">
                    <button data-toggle="tooltip" data-placement="top" title="Nova editora" class="btn-livros novo-livro">
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