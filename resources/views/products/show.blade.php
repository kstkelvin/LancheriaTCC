@extends('layouts.master')
@section('content')
  <br>
  <form action="/produto/{{$product->id}}/excluir" id="delete_product" method="POST">
    {{csrf_field()}}
    <input type="hidden" name="id" price="{{$product->id}}" />
  </form>
  <div class="album">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card-body card mb-12 box-shadow">
            <h3>Produto: {{$product->name}}</h3>
            <p>{{'Preço: R$ ' . number_format($product->price, 2, ',', '.')}}<br>
              Quantia no estoque: {{$product->stock}}</p>
              <div class="form-group d-flex justify-content-start align-items-start flex-column flex-md-row form-inline">
                <a href="/produto/{{$product->id}}/editar" class="d-md-inline-block btn btn-sm btn-secondary mr-1" title="Editar">
                  <span class="fa fa-pencil fa-fw" aria-hidden="true"></span>Editar
                </a>
                <button type="submit" form="delete_product" formmethod="post" onclick="return delete_confirm_product()" class="mr-1 d-md-inline-block btn btn-sm btn-secondary" title="Excluir">
                  <span class="fa fa-trash fa-fw" aria-hidden="true"></span>Excluir
                </button>
                <a href="/produto/{{$product->id}}/estoque" class="d-md-inline-block mr-1 btn btn-sm btn-secondary" title="Estoque">
                  <span class="fa fa-plus fa-fw" aria-hidden="true"></span>Estoque
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br>
    <center>
      {!! $chart_products->html() !!}
    </center>
  </div>
@endsection
{!! Charts::scripts() !!}
{!! $chart_products->script() !!}
