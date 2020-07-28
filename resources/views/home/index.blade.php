@extends('layouts.app')

@section('content')

<div class="container">
    @if (Session::has('fail-message'))
    <div class="row">
        <div class="col-12 alert alert-danger" role="alert">
            <strong>{{ Session::get('fail-message') }}</strong>
        </div>
    </div>
    @endif
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
