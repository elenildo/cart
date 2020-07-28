@extends('layouts.admin')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-12">
      <div class="painel admin-nav">
        <a href="{{ url()->previous() }}">Voltar</a>
      </div>
    </div>
  </div>
</div>

@endsection
