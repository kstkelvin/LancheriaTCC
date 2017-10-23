@extends('layouts.master')


@section('content')

  <div class="marging-padding">
    <h3>Produto: {{$product->name}}</h3>
    {{'Preço: R$ ' . number_format($product->value, 2, ',', '.')}}
    <p>Estoque: {{$product->stock}}</p>
    <hr>
    <a href="/produto/{{$product->id}}/editar" class="startingpad">Editar</a>
    <a href="/produto/{{$product->id}}/estoque" class="endingpad">Estoque</a>
  </div>
@endsection
