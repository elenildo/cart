@extends('layouts.app')

@section('content')
@php
$total = 0;
@endphp
<div class="container">
    Carrinho de compras
    <div class="row">
        @forelse ($orders as $order)
        <div class="col-12 mb-2">
            <div class="painel">
                <span style="font-weight: bold">Pedido nº {{ $order->id }}</span>
                <span style="float: right">Data: {{ $order->created_at->format('d/m/Y H:i')}}</span>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Foto</th>
                            <th scope="col">Produto</th>
                            <th scope='col'>Qtd</th>
                            <th scope="col">Preço</th>
                            <th scope="col">Desconto</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($order->order_products as $orderProduct)
                        @php
                            $total += $orderProduct->getTotal()
                        @endphp
                        <tr>
                            <td><img width="50px" height="50px" src='{{ asset("storage/{$orderProduct->product->image}") }}' alt="{{ $orderProduct->product->name }}"></td>
                            <td>{{ $orderProduct->product->name }}</td>
                            <td>
                                <a style="padding:0 10px;background:silver" href="{{ route('carrinho.adicionar', $orderProduct->product->id ) }}">+</a> 
                                {{ $orderProduct->qtd }} 
                                <a style="padding:0 10px;background:silver" href="{{ route('carrinho.remover', $orderProduct->product->id ) }}">-</a></td>
                            <td>{{ number_format($orderProduct->value, 2, ',', '.') }}</td>
                            <td>{{ number_format($orderProduct->discount, 2, ',', '.') }}</td>
                            <td>{{ number_format($orderProduct->getTotal(), 2, ',', '.') }}</td>
                        </tr>
                        @empty
                            <tr><td colspan="6">Não existem itens para este pedido</td></tr>
                        @endforelse
                        @if ($total > 0)
                            <tr>
                                <td colspan="5">
                                    <a href="{{ route('carrinho.finalizar', $order->id) }}"><span class="btn btn-success float-right">Finalizar compra</span></a>
                                    <a href="{{ route('homepage') }}"><span class="btn btn-outline-success float-right mr-1">Continuar comprando</span></a>
                                </td>
                                <td><span style="color:darkblue">Total: R$ {{ number_format($total, 2, ',', '.') }}</span></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
       
        @empty
        <div class="col-12">
            <p>O carrinho está vazio</p>
        </div>
        @endforelse
       
    </div>
</div>

@endsection
