@extends('layouts.app')

@section('content')

<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        {{-- <a class="navbar-brand" href="#">Navbar</a> --}}
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse font-2" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown active">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Hardware
              </a>
              <div class="dropdown-menu" >
                <a class="dropdown-item" href="#">Placas de vídeo</a>
                <a class="dropdown-item" href="#">Memórias</a>
                {{-- <div class="dropdown-divider"></div> --}}
                <a class="dropdown-item" href="#">Processadores</a>
              </div>
            </li>
            <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Periféricos
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="#">Monitores</a>
                  <a class="dropdown-item" href="#">Impressoras</a>
                  {{-- <div class="dropdown-divider"></div> --}}
                  <a class="dropdown-item" href="#">Teclado/Mouse</a>
                </div>
              </li>
            {{-- <li class="nav-item">
              <a class="nav-link" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </li> --}}
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
          </form>
        </div>
      </nav>

    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators">
            @foreach ($banners as $key=>$item)
            <li data-target="#carouselExampleFade" data-slide-to="{{$key}}"></li>
            @endforeach
        </ol>
        <div class="carousel-inner">
            @forelse ($banners as $key=>$item)
            <div class="{{ ($key == 0) ? 'carousel-item active' : 'carousel-item'  }}">
                <img class="d-block w-25 mx-auto" src="{{ asset("storage/{$item->image}") }}" alt="{{ $item->title }}">
            </div>
            @empty
            <div class="carousel-item active">
                <img class="d-block w-100 mx-auto" src="{{ asset('site_images/wild.jpg')}}" alt="Sem imagem">
            </div>
            @endforelse
        </div>
        <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Anterior</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Próximo</span>
        </a>
    </div>
    @if (Session::has('fail-message'))
    <div class="row">
        <div class="col-12 alert alert-danger" role="alert">
            <strong>{{ Session::get('fail-message') }}</strong>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="painel">
                <h3>Destaques</h3>
            </div>
            {{-- <div class="input-group painel px-5">
                <input type="text" class="form-control" placeholder="O que você está procurando?" aria-label="O que você está procurando?" aria-describedby="button-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2">Buscar</button>
                </div>
            </div> --}}
            
        </div>
    </div>
    <div class="row">
        @forelse ($products as $item)
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="oferta">
                <a href="{{ route('produto', $item->id) }}">
                <div class="imagem">
                    <img src='{{ asset("storage/{$item->image}") }}' alt="{{ $item->name }}">
                </div>
                <h5>{{ $item->name}}</h5>
                <h4>R$ {{ number_format($item->price, 2, ',', '.') }}</h4>
                </a>
            </div>
        </div>
        @empty
        <div class="col-12 text-center">
            <h2>Ainda não existem produtos cadastrados</h2>
            <p>Faça login e acesse a página de Administração para cadastrar novos produtos</p>
        </div>
        @endforelse
    </div>
</div>

@endsection
