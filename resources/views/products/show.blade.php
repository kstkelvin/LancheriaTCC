@extends('layouts.master')


@section('content')

<div class=heftymargins>
  <h2>{{$product->name}}</h2>
  <br>
  {{'Preço: R$ ' . number_format($product->value, 2, ',', '.')}}
  <br>
  <a href="/product/{{$product->id}}/edit" class="btn btn-success">Editar</a>

</div>
@endsection
