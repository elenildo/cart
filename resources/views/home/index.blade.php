@extends('layouts.app')

@section('content')



<div class="container">
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
        <div class="carousel-inner">
            @forelse ($products as $key=>$item)
            <div class="{{ ($key == 0) ? 'carousel-item active' : 'carousel-item'  }}">
                <img class="d-block w-25 mx-auto" src="{{ asset("storage/{$item->image}") }}" alt="Primeiro Slide">
            </div>
            @empty
            <div class="carousel-item active">
            <img class="d-block w-25 mx-auto" src="{{ asset('site_images/wild.jpg')}}" alt="Primeiro Slide">
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
            <div class="input-group painel px-5">
                <input type="text" class="form-control" placeholder="O que você está procurando?" aria-label="O que você está procurando?" aria-describedby="button-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2">Buscar</button>
                </div>
            </div>
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
