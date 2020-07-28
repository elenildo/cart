@extends('layouts.admin')

@section('content')

<div class="container">
    <h2>{{ isset($role) ? $role->name : 'Novo Perfil' }}</h2>
    <div class="row">
      <div class="col-12">
        <div class="painel admin-nav">
          <a href="{{ url()->previous() }}">Voltar</a>
        </div>
        <div class="painel">
          @if (isset($role))
          <form action="{{ route('admin.papeis.atualizar', $role) }}" method="POST" class="form">
            @method('PUT')
          @else
          <form action="{{ route('admin.papeis.salvar') }}" method="POST" class="form">
          @endif
            @csrf
            <div class="form-row">
              <div class="form-group col-6">
                <input type="text" name="name" value="{{ $role->name ?? '' }}" class="form-control" placeholder="Nome" maxlength="50" required>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-12">
                <textarea name="description" cols="30" rows="10" class="form-control" required>{{ $role->description ?? '' }}</textarea>
              </div>
            </div>
            <button class="btn btn-success">Salvar</button>
          </form>
        </div>
      </div>
      <div class="col-12">
        @if (isset($role))
          <hr>
          <h3>Permissões</h3>
          @foreach ($role->permissions as $permission)
          <a href="" title="{{ $permission->description }}"><strong>{{ $permission->name }};</strong></a>
          @endforeach
          <a href="{{ route('admin.papeis.permissoes', $role->id) }}"><span class="btn btn-primary" title="Adicionar Permissão">+</span></a>
        @endif
      </div>
    </div>
</div>

@endsection
