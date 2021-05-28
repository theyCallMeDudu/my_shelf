@extends('layouts.main')

@section('title', 'Gestão - Admin')

@section('content')
<div class="center">
        <!-- div busca -->
        <div id="search-container" class="col-md-12 busca">
            <h1>Gestão de usuários</h1>
            
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
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col" class="text-center">Admin</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)

                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td style="word-break: break-all;">{{ $user->email }}</td>
                    
                    @if ($user->is_admin == 1)
                    <td class="text-center">
                        <input type="checkbox" id="scales" name="scales" checked>
                    </td>    
                    @else
                    <td class="text-center">
                        <input type="checkbox" id="scales" name="scales">
                    </td>
                    @endif
                    <td>
                        <!-- botão editar -->
                        <a href="" style="text-decoration: none;">
                            <button class="btn-livros" data-toggle="tooltip" data-placement="top" title="Editar">
                                <i class="fas fa-pencil-alt"></i>
                            </button>    
                        </a>

                        <!-- form e botão excluir -->
                        <form action="" method="POST">
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