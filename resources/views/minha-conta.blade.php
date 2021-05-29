@extends('layouts.main')

@section('title', 'Minha Conta')

@section('content')
    <div class="center">
        <div class="box-conta">
            <h1>Olá, {{ $user->name }}!</h1>
            <hr>
            <div class="div-img-user">
                <img class="user-img" src="/img/profile.png" alt="">
            </div>
            <div class="dados-dados-user" id="btn-user">
                <button class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Editar dados" style="float: right;">
                    <i class="fas fa-pencil-alt"></i>
                </button>

                <p><strong>Dados do usuário</strong></p>
                <p>Nome: {{ $user->name }}</p>
                <p>E-mail: {{ $user->email }}</p>
                
                <div>
                    <p><strong>Estante</strong></p>
                    <ul>
                        <li>
                            <div>
                                <i class="fas fa-book" style="color: white; background-color: green;"></i> Livros lidos: 
                            </div>
                        </li>
                        <li>
                            <div>
                                <i class="fas fa-book" style="color: black; background-color: yellow;"></i> Livros lendo: 
                            </div>
                        </li>
                        <li>
                            <div>
                                <i class="fas fa-book" style="color: white; background-color: red;"></i>Livros para ler: 
                            </div>
                        </li>
                        <li>
                            <div>
                                <i class="fas fa-book" style="color: white; background-color: black;"></i>Total: 
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>

    <!-- Modal editar dados do usuário -->
    <div class="modal fade" id="modalUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar dados da conta</h5>
                    <button id="btn-close-user-01" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    Selecione um status
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group">    
                            <label for="name">Nome</label>
                            <input class="form-control" type="text" id="name" name="name" required>
                        </div>

                        <div class="form-group">    
                            <label for="email">E-mail</label>
                            <input class="form-control" type="email" id="email" name="email" required>
                        </div>

                        <div class="form-group">    
                            <label for="foto">Foto do perfil</label>
                            <input class="form-control" type="file" id="foto" name="foto">
                        </div>

                        <button id="btn-close-user-02" type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>

               
            </div>
        </div>
    </div>
@endsection