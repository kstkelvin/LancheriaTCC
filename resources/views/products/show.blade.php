@extends('layouts.master')


@section('content')

  <div>
    <h1>Produto: {{$product->name}}</h1>
    <hr>
    {{'Preço: R$ ' . number_format($product->value, 2, ',', '.')}}
    <p>Quantia no estoque: {{$product->stock}}</p>
    <div class="form-group">
      <a href="/produto/{{$product->id}}/editar" class="btn btn-success linkbutton linkmargin button-panel" title="Editar">
        <span class="fa fa-pencil fa-fw" aria-hidden="true"></span>Editar
      </a>

      <form action="/produto/{{$product->id}}/excluir" method="POST">
        {{csrf_field()}}
        <input type="hidden" name="id" value="{{$product->id}}" />
        <button type="submit" class="btn btn-success linkbutton linkmargin button-panel" title="Excluir">
          <span class="fa fa-trash fa-fw" aria-hidden="true"></span>Excluir
        </button>
      </form>
      <a href="/produto/{{$product->id}}/estoque" class="btn btn-success linkbutton linkmargin button-panel" title="Pagamento">
        <span class="fa fa-money fa-fw" aria-hidden="true"></span>Estoque
      </a>
    </div>
  </div>
  <br>
  <hr>
</div>

@endsection
