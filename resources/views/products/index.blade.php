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
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($products as $product)
          <tr>
            <td><a href="/produto/{{$product->id}}">{{ $product->name }}</a></td>
            <td>{{'R$ ' . number_format($product->value, 2, ',', '.')}}</td>
            <td>{{$product->stock}}</td>
            <td>
              <div class="form-inline">
                <form action="/produto/{{$product->id}}/editar" method="GET">
                  {{csrf_field()}}
                  <button type="submit" class="linkbutton">
                    <span class="fa fa-pencil fa-fw" aria-hidden="true"></span>
                  </button>
                </form>
                <form action="/produto/{{$product->id}}/excluir" method="POST">
                  {{csrf_field()}}
                  <input type="hidden" name="id" value="{{$product->id}}" />
                  <button type="submit" class="linkbutton">
                    <span class="fa fa-trash fa-fw" aria-hidden="true"></span>
                  </button>
                </form>
              </div>
            </td>
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
