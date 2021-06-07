@extends('layouts.main')

@section('title', 'Gestão - Admin')

@section('content')
<div class="center">
    <h1>Gestão de usuários</h1>
        <!-- div busca -->
        <!-- <div id="search-container" class="col-md-12 busca">
            
            <form action="">
                <input type="text" id="search" name="search" class="form-control" placeholder="Buscar">
            </form>
        </div> -->

        <!-- div tabela -->
        <div id="livros-container" class="col-md-12" style="padding: 0;">
        <table class="table table-livros" id="data-table-usuarios">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col" class="text-center">Admin</th>
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
                        <input class="admin-check" data-href="{{ $user->id }}" type="checkbox" id="admin" name="admin" value="{{ $user->id }}" checked>
                    </td>    
                    @else
                    <td class="text-center">
                        <input class="admin-check" data-href="{{ $user->id }}" type="checkbox" id="admin" name="admin" value="{{ $user->id }}">
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<!-- Modal tornar admin -->
<div class="modal fade" id="modalAdmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Conceder acesso de administrador</h5>
                    <button id="btn-close-admin-01" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body">
                    <p>Deseja conceder acesso de administrador a este usuário?</p>
                    <form action='/user/admin' method="POST">
                        @csrf
                        <input type="hidden" name="user_id" id="is_admin_id">                       
                        <div>
                            <button id="btn-close-admin-02" type="button" class="btn btn-success" data-bs-dismiss="modal">Não</button>
                            <button type="submit" class="btn btn-danger">Sim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal revogar admin -->
<div class="modal fade" id="modalNotAdmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Revogar acesso de administrador</h5>
                    <button id="btn-close-admin-03" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body">
                    <p>Deseja revogar o acesso de administrador deste usuário?</p>
                    
                    <form action='/user/notadmin' method="POST">
                        @csrf
                        <input type="hidden" name="user_id_not" id="is_not_admin_id">
                        <div>
                            <button id="btn-close-admin-04" type="button" class="btn btn-success" data-bs-dismiss="modal">Não</button>
                            <button type="submit" class="btn btn-danger">Sim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
@endsection