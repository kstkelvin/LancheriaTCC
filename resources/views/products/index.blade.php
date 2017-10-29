@extends('layouts.master')

@section('content')
  <div>
    <h1>Lista de Produtos</h1>
    <hr>
    <div>
      <a href="/produtos/adicionar" class="btn btn-success linkbutton" title="Adicionar Produto">
        <span class="fa fa-plus fa-fw" aria-hidden="true"></span>Adicionar Produto</a>
    </div>
    <br>
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Preço</th>
          <th>Estoque</th>
          <th></th>
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
              <a href="/produto/{{$product->id}}/editar" class="btn btn-success linkbutton" title="Editar">
                <span class="fa fa-pencil fa-fw" aria-hidden="true"></span></a>
            </td>
            <td>
              <div class="form-group">
                <form action="/produto/{{$product->id}}/excluir" method="POST">
                  {{csrf_field()}}
                  <input type="hidden" name="id" value="{{$product->id}}"  />
                  <button type="submit" class="linkbutton" target="blank" title="Excluir">
                    <span class="fa fa-trash fa-fw" aria-hidden="true"></span>
                  </button>
                </form>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
