@extends('layouts.master')

@section('content')
  <div class="heftymargins">
    <h2>Lista de Produtos</h2>
  </div>
  <hr>
  <a href="/produtos/adicionar" class="btn btn-success">Novo Produto</a>
  <hr>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Nome</th>
        <th>Preço</th>
        <th>Estoque</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($products as $product)
        <tr>
          <td><a href="/produto/{{$product->id}}">{{ $product->name }}</a></td>
          <td>{{'R$ ' . number_format($product->value, 2, ',', '.')}}</td>
          <td>{{$product->stock}}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection
