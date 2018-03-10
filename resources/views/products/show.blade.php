@extends('layouts.master')


@section('content')

  <div>
    <h1>Produto: {{$product->name}}</h1>
    <div>
      <a href="/produtos" class="btn btn-success linkbutton linkmargin button-panel" title="Voltar">
        <span class="fa fa-long-arrow-left fa-fw" aria-hidden="true"></span> Lista de Produtos
      </a>
    </div>
    <br>
    <hr>
    {{'Preço: R$ ' . number_format($product->price, 2, ',', '.')}}
    <p>Quantia no estoque: {{$product->stock}}</p>
    <div class="form-group">
      <a href="/produto/{{$product->id}}/editar" class="btn btn-success linkbutton linkmargin button-panel" title="Editar">
        <span class="fa fa-pencil fa-fw" aria-hidden="true"></span>Editar
      </a>

      <form action="/produto/{{$product->id}}/excluir" method="POST">
        {{csrf_field()}}
        <input type="hidden" name="id" price="{{$product->id}}" />
        <button type="submit" class="btn btn-success linkbutton linkmargin button-panel" title="Excluir">
          <span class="fa fa-trash fa-fw" aria-hidden="true"></span>Excluir
        </button>
      </form>
      <a href="/produto/{{$product->id}}/estoque" class="btn btn-success linkbutton linkmargin button-panel" title="Estoque">
        <span class="fa fa-plus fa-fw" aria-hidden="true"></span>Estoque
      </a>
    </div>
  </div>
  <br>
  <hr>
</div>

@endsection
