<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>@yield('title')</title>

        <!-- Fonte do Google -->
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
        <!-- Ícones Font Awesome -->
        <script src="https://kit.fontawesome.com/c0209b2941.js" crossorigin="anonymous"></script>
        <!-- CSS da aplicação -->
        <link rel="stylesheet" href="/css/estilos.css">
        <!-- CSS Bootstrap -->
        <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
        
        <!-- jQuery e Bootstrap Carousel -->
        <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
    </head>
    <body>
    <header>
        <div class="center">
            <!-- Logo -->
            <div class="logo left">                              
                <img class="logo" src="/img/my-shelf-logo.svg" alt="">
            </div>
            
            <!-- nav desktop -->
            <nav class="desktop right">
                <ul>
                    @auth
                    <li><a href="/catalogo">Catálogo</a></li>
                    <li><a href="/estante">Estante</a></li>
                    @if($is_admin != null)
                    <li class="dropdown">
                        Admin
                        <div class="dropdown-content">
                            <a href="/livros">Livros</a>
                            <a href="/assuntos">Assuntos</a>
                            <a href="/autores">Autores</a>
                            <a href="/editoras">Editoras</a>
                            <a href="/admin/gestao">Gestão de usuários</a>
                        </div>
                    </li>
                    @endif
                    
                    <li>
                        <form action="/logout" method="POST">
                        @csrf
                        <a href="/logout" 
                        onclick="event.preventDefault();
                                this.closest('form').submit();">
                            Sair
                        </a>
                    </li>
                        </form>    
                    @endauth
                    
                    @guest
                    <li><a href="/login">Entrar</a></li>
                    <li><a href="/register">Cadastrar</a></li>
                    @endguest
                </ul>
            </nav>
            
            <!-- nav mobile -->
            <nav class="mobile right">
                <div class="botao-menu-mobile">
                    <i class="fas fa-bars"></i>
                </div>
                <ul>
                @auth
                    <li><a href="/catalogo">Catálogo</a></li>
                    <li><a href="/estante">Estante</a></li>
                    @if($is_admin != null)
                    <li><a href="/livros">Livros</a></li>
                    <li><a href="/assuntos">Assuntos</a></li>
                    <li><a href="/autores">Autores</a></li>
                    <li><a href="/editoras">Editoras</a></li>
                    <li><a href="/admin/gestao">Gestão de usuários</a></li>
                    @endif
                    
                    <li>
                        <form action="/logout" method="POST">
                        @csrf
                        <a href="/logout" 
                        onclick="event.preventDefault();
                                this.closest('form').submit();">
                            Sair
                        </a>
                    </li>
                        </form>    
                    @endauth
                    
                    @guest
                    <li><a href="/login">Entrar</a></li>
                    <li><a href="/register">Cadastrar</a></li>
                    @endguest
                </ul>
            </nav>
            <div class="clear"></div>
        </div>
    </header>
    <main>
        @if (session('msg'))
            <p class="msg">{{ session('msg') }}</p>
        @endif
        @yield('content')
    </main>
          <!-- <footer>
            <p style="margin: 0; font-size: 12pt; font-weight: 300;">
                MyShelf &copy; 2021
            </p>
          </footer>  -->
          <!-- jQuery do sistema -->
          <script src="/js/jquery.js"></script>
          <!-- Booststrap JS do sistema -->
          <!-- <script type="text/javascript" href="/bootstrap/js/bootstrap.min.js"></script> -->
          <!-- JavaScript do sistema -->
          <script src="/js/scripts.js"></script>


        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>

    </body>
</html>
