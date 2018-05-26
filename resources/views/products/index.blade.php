@extends('layouts.master')

@section('content')
  <br>
  <div class="album">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card-body card box-shadow">
            <h1>Lista de Produtos</h1>
            <div class="form-group d-flex justify-content-start align-items-start flex-column flex-md-row form-inline">
              <a href="/produtos/adicionar" class="d-md-inline-block btn btn-sm btn-secondary mr-1" title="Adicionar Produto">
                <span class="fa fa-plus fa-fw" aria-hidden="true"></span>Adicionar Produto
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <br>

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="topnav">
          <div class="search-container">
            <form method="GET" action="/produtos/pesquisar">
              <input type="text" id="search" name="search"
              placeholder="Digite o nome do produto" />
              <button type="submit"><i class="fa fa-search"></i></button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <br>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <table class="table table-hover table-striped">
          <thead>
            <tr>
              <th><p class="table-header-wordwrap">NOME</p></th>
              <th><p class="table-header-wordwrap">PREÇO</p></th>
              <th><p class="table-header-wordwrap">ESTOQUE</p></th>
              <th><p class="table-header-wordwrap"></p></th>
              <th><p class="table-header-wordwrap"></p></th>
              <th><p class="table-header-wordwrap"></p></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($products as $product)
              <form id="product_arma{{$product->id}}" action="/produto/{{$product->id}}/excluir" method="POST">
                {{csrf_field()}}
                <input type="hidden" name="id" price="{{$product->id}}"/>
              </form>
              <tr>
                <td>
                  <a href="/produto/{{$product->id}}" class="btn btn-secondary button-link word-breaker button-panel">{{ $product->name }}</a>
                </td>
                <td>{{'R$ ' . number_format($product->price, 2, ',', '.')}}</td>
                <td>{{$product->stock}}</td>
                <td>
                  <a href="/produto/{{$product->id}}/editar" class="btn btn-secondary button-link button-panel" title="Editar">
                    <span class="fa fa-pencil fa-fw" aria-hidden="true"></span></a>
                  </td>
                  <td>

                    <button type="submit" form="product_arma{{$product->id}}" formmethod="post" onclick="return delete_confirm_product()" class="btn btn-secondary button-link button-panel" target="blank" title="Excluir">
                      <span class="fa fa-trash fa-fw" aria-hidden="true"></span>
                    </button>
                  </td>
                  <td>
                    <a href="/produto/{{$product->id}}/estoque" class="btn btn-secondary button-link button-panel" title="Estoque">
                      <span class="fa fa-plus fa-fw" aria-hidden="true"></span>
                    </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  @endsection
