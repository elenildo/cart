@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <div class="painel produto-detalhe detalhe-imagens">
         <img src='{{ asset("storage/{$product->image}") }}' alt="{{ $product->name }}">
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <div class="painel produto-detalhe">
            <h3>{{ $product->name }}</h3>
            <hr>
            <h2 class="text-center"><small>à vista</small> R$ {{ number_format($product->price, 2, ',', '.') }}</h2>
            <a href="{{ route('carrinho.adicionar', $product->id) }}"><p class="btn btn-success text-center">COMPRAR</p></a>
            <hr>
            <input id="cep" type="text" placeholder="Digite seu CEP"> 
            <span class="btn btn-secondary btn-sm">Calcular frete</span>
        </div>
      </div>
      <div class="col-12">
        <div class="painel produto-detalhe">
            <h4>Detalhes</h4>
            <p>{{ $product->description }}</p>
        </div>
      </div>
    </div>
</div>

@endsection