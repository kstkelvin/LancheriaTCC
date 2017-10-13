@extends('layouts.master')


@section('content')

  <div class=heftymargins>
    <h2>Produto: {{$product->name}}</h2>
    <hr>
    {{'Preço: R$ ' . number_format($product->value, 2, ',', '.')}}
    <br>
    <hr>
    <a href="/product/{{$product->id}}/edit" class="btn btn-success">Editar</a>

  </div>
@endsection
