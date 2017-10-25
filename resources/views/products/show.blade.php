@extends('layouts.master')


@section('content')

  <div class="marging-padding">
    <h3>Produto: {{$product->name}}</h3>
    {{'Preço: R$ ' . number_format($product->value, 2, ',', '.')}}
    <p>Estoque: {{$product->stock}}</p>
    <hr>
    <form action="/produto/{{$product->id}}/excluir" method="POST">
      {{csrf_field()}}
      <a href="/produto/{{$product->id}}/editar" class="btn btn-primary">Editar</a>
      <a href="/produto/{{$product->id}}/estoque" class="btn btn-secondary">Estoque</a>
      <input type="hidden" name="id" value="{{$product->id}}" />
      <button type="submit" class="btn btn-danger">Deletar</button>
    </form>
  </div>
@endsection
