<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonte do Google -->
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
        <!-- Ícones Font Awesome -->
        <script src="https://kit.fontawesome.com/c0209b2941.js" crossorigin="anonymous"></script>
        <!-- CSS da aplicação -->
        <link rel="stylesheet" href="/css/estilos.css">
        <!-- CSS Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>
    <body>
    <header>
        <div class="center">
            <!-- Logo -->
            <div class="logo left">
                <a href="/">
                    <img class="logo" src="/img/my-shelf-logo.svg" alt="">
                </a>
            </div>
            
            <!-- nav desktop -->
            <nav class="desktop right">
                <ul>
                    @auth
                    <li><a href="/estante">Estante</a></li>
                    <li><a href="/livros">Livros</a></li>
                    <li><a href="/assuntos">Assuntos</a></li>
                    <li><a href="/autores">Autores</a></li>
                    <li><a href="/editoras">Editoras</a></li>
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
                    <li><a href="/estante">Estante</a></li>
                    <li><a href="/livros">Livros</a></li>
                    <li><a href="/assuntos">Assuntos</a></li>
                    <li><a href="/autores">Autores</a></li>
                    <li><a href="/editoras">Editoras</a></li>
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
            <!-- JavaScript do sistema -->
            <script src="js/jquery.js"></script>
            <script src="js/scripts.js"></script>
    </body>
</html>
