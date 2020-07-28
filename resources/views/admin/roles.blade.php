@extends('layouts.admin')

@section('content')

<div class="container">
    <h2>Perfis</h2>
    <div class="row">
      <div class="col-12">
        <div class="painel admin-nav">
          <a href="{{ url()->previous() }}">Voltar</a>
          <a href="{{ route('admin.papeis.adicionar') }}">Novo</a>
        </div>
      </div>
    </div>
    <table class="table table-bordered">
      <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Descrição</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          @forelse ($roles as $item)
          <tr>
          <th scope="row">{{ $item->id }}</th>
              <td><a href="{{ route('admin.papeis.editar', $item->id) }}">{{ $item->name }}</a></td>
              <td>{{ $item->description }}</td>
              <td><a href="{{ route('admin.papeis.permissoes', $item->id) }}">Permissões</a></td>
          </tr>
          @empty
          <tr><td colspan="4" class="text-center">A busca não encontrou resultados</td></tr>
          @endforelse
         
        </tbody>
  </table>
</div>

@endsection
