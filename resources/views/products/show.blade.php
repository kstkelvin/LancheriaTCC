@extends('layouts.master')


@section('content')

  <div class=heftymargins>
    <h2>Produto: {{$product->name}}</h2>
    <hr>
    {{'Preço: R$ ' . number_format($product->value, 2, ',', '.')}}
    <br>
    <p>Estoque: {{$product->stock}}</p>
    <br>
    <a href="/produto/{{$product->id}}/editar" class="startingpad">Editar</a>
    <a href="/produto/{{$product->id}}/estoque" class="endingpad">Estoque</a>
    <hr>

    @include('layouts.errors')

  </div>
@endsection
