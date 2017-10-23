@extends('layouts.master')

@section('content')
  <div class="marging-padding">
    <h3>Lista de Produtos</h3>
    <br>
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
      <hr>
      <div class="d-flex justify-content-end">
        <a href="/produtos/adicionar" class="btn btn-success">Adicionar Produto</a>
      </div>
    </div>
  @endsection
