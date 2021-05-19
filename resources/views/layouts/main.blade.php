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
    </head>
    <body>
    <header>
        <div class="center">
            <!-- Logo -->
            <div class="logo left">
                <a href="/estante">
                    <img class="logo" src="/img/my-shelf-logo.png" alt="">
                </a>
            </div>
            
            <!-- nav desktop -->
            <nav class="desktop right">
                <ul>
                <li><a href="">Estante</a></li>
                    <li><a href="/livros">Livros</a></li>
                    <li><a href="">Autores</a></li>
                    <li><a href="">Editoras</a></li>
                    <li><a href="">Assuntos</a></li>
                </ul>
            </nav>
            
            <!-- nav mobile -->
            <nav class="mobile right">
                <div class="botao-menu-mobile">
                    <i class="fas fa-bars"></i>
                </div>
                <ul>
                    <li><a href="">Estante</a></li>
                    <li><a href="/livros">Livros</a></li>
                    <li><a href="">Autores</a></li>
                    <li><a href="">Editoras</a></li>
                    <li><a href="">Assuntos</a></li>
                </ul>
            </nav>
            <div class="clear"></div>
        </div>
    </header>

    @yield('content')
          <footer>
            <p style="margin: 0; font-size: 12pt; font-weight: 300;">
                MyShelf &copy; 2021
            </p>
          </footer> 
            <!-- JavaScript do sistema -->
            <script src="js/jquery.js"></script>
            <script src="js/scripts.js"></script>
    </body>
</html>
