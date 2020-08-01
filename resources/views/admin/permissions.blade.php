@extends('layouts.admin')

@section('content')

<div class="container">
  Administração
  <div class="row">
    <div class="col-12">
      <div class="painel admin-nav">
        <a href="{{ url()->previous() }}">Voltar</a>
      </div>
    </div>

    <div class="col-12">
      <h3>{{ $role->name }}</h3>
      <form action="{{ route('admin.papeis.atualizarPermissoes', $role) }}" method="POST" class="form">
        @csrf
        @method('PUT')
        <input type="hidden" name="role_id" value="{{ $role->id ?? ''}}">
        <div class="form-row">
          <div class="form-group col-12">
            <label for="exampleFormControlSelect2">Selecione uma ou mais Permissões para {{ $role->name}}</label>
            <select name="permissions[]" multiple class="form-control" id="exampleFormControlSelect2" style="min-height: 200px;">
              @forelse ($allPermissions as $item)
              <option value="{{ $item->id }}" @if($role->permissions->pluck('id')->contains($item->id)) selected @endif>{{ $item->name }} -> {{ $item->description}}</option>
              @empty
              <option>Não há permissões cadastradas</option>
              @endforelse
            </select>
          </div>
        </div>
        <button class="btn btn-success float-right">Salvar</button>
      </form>
      @if(Auth::user()->isAdmin())
      <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" 
        title="Adicionar Permissão">+</button>
      @endif
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Adicionar permissões</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('admin.papeis.salvarPermissao', $role) }}" method="POST" class="form">
          @csrf
          <div class="form-row">
            <div class="form-group col-8">
              <input type="text" name="name" placeholder="Nome da permissão" maxlength="50" class="form-control" required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-12">
              <textarea name="description" cols="30" rows="5" class="form-control" required placeholder="Descrição da permissão"></textarea>
            </div>
          </div>
          <button class="btn btn-primary">Salvar</button>
        </form>
      </div>
      {{-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> --}}
    </div>
  </div>
</div>

@endsection
