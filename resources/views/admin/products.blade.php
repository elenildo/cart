@extends('layouts.admin')

@section('content')

<div class="container">
    <h2>Produtos</h2>
    <div class="row">
      <div class="col-12">
        <div class="painel admin-nav">
          <a href="{{ url()->previous() }}">Voltar</a>
          <a href="{{ route('admin.produtos.adicionar') }}">Novo</a>
        </div>
      </div>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nome</th>
              <th scope="col">Descrição</th>
              <th scope="col">Preço</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($products as $item)
            <tr>
            <th scope="row">{{ $item->id }}</th>
                <td><a href="{{ route('admin.produtos.editar', $item->id) }}">{{ $item->name }}</a></td>
                <td>{{ $item->description }}</td>
                <td>{{ number_format($item->price, 2, ',', '.')}}</td>
            </tr>
            @empty
            <tr><td colspan="4" class="text-center">A busca não encontrou resultados</td></tr>
            @endforelse
           
          </tbody>
    </table>
    {{ $products->links() }}
</div>

@endsection
