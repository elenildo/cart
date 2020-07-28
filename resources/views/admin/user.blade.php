@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row">
      <div class="col-12">
        <div class="painel admin-nav">
          <a href="{{ url()->previous() }}">Voltar</a>
        </div>
        <div class="painel">
          @if (isset($user))
          <h4>Usuário: {{ $user->name }}</h4>
          <h4>Email: {{ $user->email }}</h4>
          <form action="{{ route('admin.usuarios.atualizar', $user) }}" method="POST" class="form" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id ?? ''}}">
            <div class="form-row">
                <div class="form-group col-12">
                    <label for="exampleFormControlSelect2">Selecione um ou mais Papéis para {{ $user->name}}</label>
                    <select name="roles[]" multiple class="form-control" id="exampleFormControlSelect2" style="min-height: 200px;">
                    @forelse ($allRoles as $item)
                    <option value="{{ $item->id }}" @if($user->roles->pluck('id')->contains($item->id)) selected @endif>{{ $item->name }} -> {{ $item->description}}</option>
                    @empty
                    <option>Não há perfis cadastrados</option>
                    @endforelse
                    </select>
                </div>
            </div>
            <hr>
            <button class="btn btn-success">Salvar</button>
          </form>
          @else
          <p>Usuário inexistente</p>
          @endif
        </div>
      </div>
    </div>
    
</div>

@endsection
