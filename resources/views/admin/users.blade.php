@extends('layouts.admin')

@section('content')

<div class="container">
    <h2>Usuários</h2>
    <div class="row">
      <div class="col-12">
        <div class="painel admin-nav">
          <a href="{{ url()->previous() }}">Voltar</a>
          @can('manage_roles')
          <a href="{{ route('admin.papeis') }}">Perfis</a>
          @endcan
        </div>
      </div>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nome</th>
              <th scope="col">e-mail</th>
              <th scope="col">Perfil</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($users as $item)
            <tr>
            <th scope="row">{{ $item->id }}</th>
                <td><a href="{{ route('admin.usuarios.editar', $item->id) }}">{{ $item->name }}</a></td>
                <td>{{ $item->email }}</td>
                <td>{{ implode(',', $item->roles->pluck('name')->toArray()) }}</td>
            </tr>
            @empty
            <tr><td colspan="4" class="text-center">A busca não encontrou resultados</td></tr>
            @endforelse
           
          </tbody>
    </table>
    {{ $users->links() }}
</div>

@endsection
