@extends('layouts.admin')

@section('extra-head')
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" /> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />
@endsection

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
              <th scope="col">Visível no Banner</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($products as $item)
            <tr class="{{ ($item->active == 'N')? 'bg-warning' : '' }}">
            <th scope="row">{{ $item->id }}</th>
                <td><a href="{{ route('admin.produtos.editar', $item->id) }}">{{ $item->name }}</a></td>
                <td>{{ \Illuminate\Support\Str::limit($item->description , 50, $end='...') }}</td>
                <td>{{ number_format($item->price, 2, ',', '.')}}</td>
                <td>
                @if ($item->banner == 1)
                <i class="fas fa-check text-success"></i> 
                @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="text-center">A busca não encontrou resultados</td></tr>
            @endforelse
           
          </tbody>
    </table>
    {{ $products->links() }}
</div>

@endsection
