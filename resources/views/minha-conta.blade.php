@extends('layouts.main')

@section('title', 'Minha Conta')

@section('content')
    <div class="center">
        <div class="box-conta">
            <h1>Olá, {{ $user->name }}!</h1>
            <hr>
            <div class="div-img-user">
                @if (isset($user->relFoto->nome))
                    <img src="{{ asset('storage/' . $user->relFoto->nome) }}" alt="" width="200px;">
                @else
                    <img class="user-img" src="/img/profile.png" alt="">
                @endif

                <div class="estatisticas">
                    <ul>
                        <li>
                            <strong>Estatísticas</strong>
                        </li>
                        <li>
                            <div>
                                <i class="fas fa-book" style="color: white; background-color: green;"></i> Livros lidos:
                                    {{ $lidos }}
                            </div>
                        </li>
                        <li>
                            <div>
                                <i class="fas fa-book" style="color: black; background-color: yellow;"></i> Livros lendo: 
                                {{ $lendo }}
                            </div>
                        </li>
                        <li>
                            <div>
                                <i class="fas fa-book" style="color: white; background-color: red;"></i>Livros para ler: 
                                {{ $ler }}
                            </div>
                        </li>
                        <li>
                            <div>
                                <i class="fas fa-book" style="color: white; background-color: black;"></i>Total: 
                                {{ $total }}
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="div-dados-user">
                <div class="div-acoes-conta">
                    <button id="btn-editar-dados" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Editar dados" style="margin-bottom: 20px;">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                    
                    <button id="btn-deletar-conta" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Excluir conta">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>    

                <p><strong>Dados do usuário</strong></p>
                <p>Nome: {{ $user->name }}</p>
                <p>E-mail: {{ $user->email }}</p>
                
                <hr>

                
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
                    <form action="{{ route('updateUser', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group">    
                            <label for="name">Nome</label>
                            <input class="form-control" type="text" id="name" name="name" value="{{ $user->name }}" required>
                        </div>

                        <div class="form-group">    
                            <label for="email">E-mail</label>
                            <input class="form-control" type="email" id="email" name="email" value="{{ $user->email }}" required>
                        </div>

                        <div class="form-group">    
                            <label for="foto">Foto do perfil</label>
                            <input class="form-control" type="file" id="foto" name="foto">
                        </div>

                        <button id="btn-close-user-02" type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>

                    @if (isset($user->relFoto->nome))
                    <form action="{{ route('removerFoto') }}" method="POST">
                        @csrf
                        <input type="hidden" name="fotoUser" value="{{ $user->relFoto->nome }}">
                        <h6>Foto do perfil</h6>
                        <img src="{{ asset('storage/' . $user->relFoto->nome) }}" alt="Título do livro: {{ $user->name }}" class="img-preview" style="display: block;">        
                        <button type="submit" class="btn btn-danger" style="display: inline-block; margin: 10px;" data-toggle="tooltip" data-placement="top" title="Remover imagem">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal excluir conta -->
    <div class="modal fade" id="modalDeleteUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Exclusão de conta</h5>
                    <button id="btn-close-delete-01" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    Deseja realmente excluir sua conta?
                    <form action="{{ route('excluir', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="id_user" id="id_user" value="$user->id">
                        <button id="btn-close-delete-02" type="button" class="btn btn-success" data-bs-dismiss="modal">Não</button>
                        <button type="submit" class="btn btn-danger">Sim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
@endsection