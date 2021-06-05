@extends('layouts.main')

@section('title', 'MyShelf')

@section('content')

<div id="carouselExampleIndicators" class="carousel slide center" data-ride="carousel" style="margin-top: 30px;">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <div class="carousel-item active">
            <img class="d-block w-100" src="/img/banner_01.png" alt="Slide Todas as suas leituras em um só lugar">
        </div>
        <div class="carousel-item">
                <img class="d-block w-100" src="/img/banner_02.png" alt="Imagem de óculos sobre pilha de livros retirada de freepik.com">
        </div>
        <div class="carousel-item">
            <a href="/register">
                <img class="d-block w-100" src="/img/banner_03.png" alt="Slide cadastre-se">
            </a>
        </div>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>

<div class="box-ultimos center">
    <h5>Últimos títulos cadastrados</h5>
    <div style="background-color: #ce9d5a; padding: 10px 0 0 10px; margin-bottom: 50px;">
        <ul>
            @foreach ($ultimos as $ultimo)
            <li>
                <a href="/livros/{{ $ultimo->id }}">
                    @if (isset($ultimo->relCapaLivro->nome))
                    <img class="capa-livro" src="{{ asset('storage/' . $ultimo->relCapaLivro->nome)  }}" alt="{{ $ultimo->titulo }}" title="{{ $ultimo->titulo }}">
                    @else
                    <img class="capa-livro" src="/img/sem_capa.png" alt="{{ $ultimo->titulo }}" title="{{ $ultimo->titulo }}">
                    @endif
                </a>
            </li>
            @endforeach
        </ul>
    <p style="color: #ce9d5a;">Olá</p>
    </div>
</div>

<div class="box-ultimos-mobile center">
    <div id="carouselUltimos" class="carousel slide center" data-ride="carousel" style="padding-top: 20px;">
        <div class="carousel-inner">
            <a class="carousel-control-prev" href="#carouselUltimos" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            
            @foreach ($ultimos as $ultimo)
            <div class="carousel-item">
                    <a href="/livros/{{ $ultimo->id }}">
                    @if (isset($ultimo->relCapaLivro->nome))
                    <img class="capa-livro" src="{{ asset('storage/' . $ultimo->relCapaLivro->nome)  }}" alt="{{ $ultimo->titulo }}">
                    @else
                    <img class="capa-livro" src="/img/sem_capa.png" alt="{{ $ultimo->titulo }}">
                    @endif
                    </a>
            </div>
            
            <a class="carousel-control-next" href="#carouselUltimos" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
            @endforeach
        </div>
    </div>
</div>

@endsection