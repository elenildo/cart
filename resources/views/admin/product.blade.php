@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row">
      <div class="col-12">
        <div class="painel admin-nav">
          <a href="{{ url()->previous() }}">Voltar</a>
        </div>
        <div class="painel">
          @if (isset($product))
          <form action="{{ route('admin.produtos.atualizar', $product) }}" method="POST" class="form" enctype="multipart/form-data">
            @method('PUT')
          @else
          <form action="{{ route('admin.produtos.salvar') }}" method="POST" class="form" enctype="multipart/form-data">
          @endif
            @csrf
            <div class="form-row">
              <div class="form-group col-2">
                <select name="active" id="" class="form-control">
                  <option value="Y" @if(isset($product) && $product->active == 'Y') selected @endif>Ativo</option>
                  <option value="N" @if(isset($product) && $product->active == 'N') selected @endif>Inativo</option>
                </select>
              </div>
              <div class="form-group col-8">
                <div class="form-check">
                  <input name="banner" class="form-check-input" type="checkbox" value="1" id="banner" {{ isset($product->banner) ? 'checked' : '' }}>
                  <label class="form-check-label" for="banner">Exibir no banner da home</label>
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-6">
                <input type="text" name="name" value="{{ $product->name ?? '' }}" class="form-control" placeholder="Nome" maxlength="50" required>
              </div>
              <div class="form-group col-2">
                <input type="number" name="price" value="{{ $product->price ?? '' }}" step=".01" class="form-control" placeholder="Preço" required>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-12">
                <textarea name="description" cols="30" rows="10" class="form-control" required>{{ $product->description ?? '' }}</textarea>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group">
                <img src='{{ isset($product) ? asset("storage/{$product->image}") : "" }}' alt="" style="width: 100px; display:block">
                <label for="file" class="btn btn-secondary">{{ isset($product->image)? 'Alterar' : 'Adicionar' }} foto</label>
                <input type="file" name="image" value="{{ $product->image ?? '' }}" {{ isset($product->image) ? '' : 'requided' }} id="file" style="display: none">
                <span class="text-danger ml-1">Somente imagens no tamanho <strong>640x480</strong></span>
              </div>
            </div>

            @can('edit_products')
            <hr>
            <button class="btn btn-success">Salvar</button>
            @endcan
            
          </form>
        </div>
      </div>
    </div>
    
</div>

@endsection
