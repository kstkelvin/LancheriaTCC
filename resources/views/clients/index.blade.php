@extends('layouts.master')

@section('content')
  <br>
  <div class="album">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card-body card box-shadow">
            <h1>Lista de Clientes</h1>
            <div class="form-group d-flex justify-content-start align-items-start flex-column flex-md-row form-inline">
              <a href="/clientes/adicionar" class="d-md-inline-block btn btn-sm btn-secondary mr-1" title="Adicionar Cliente">
                <span class="fa fa-plus fa-fw" aria-hidden="true"></span>Adicionar Cliente
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
            <form method="GET" action="/clientes/pesquisar">
              <input type="text" id="search" name="search"
              placeholder="Digite o nome do cliente" />
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
              <th><p class="table-header-wordwrap"></p></th>
              <th><p class="table-header-wordwrap"></p></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($clients as $client)
              <form id="client_arma{{$client->id}}" action="/cliente/{{$client->id}}/excluir" method="POST">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$client->id}}" />
              </form>
              <tr>
                <td>
                  <a href="/cliente/{{$client->id}}" class="word-breaker btn btn-secondary button-link button-panel">{{ $client->name . " " .
                    $client->surname }}</a>
                  </td>
                  <td>
                    <a href="/cliente/{{$client->id}}/editar" class="btn btn-secondary button-link button-panel" title="Editar">
                      <span class="fa fa-pencil fa-fw" aria-hidden="true"></span>
                    </a>
                  </td>
                  <td>
                    <button type="submit" form="client_arma{{$client->id}}" formmethod="post" onclick="return delete_confirm_client()" class="btn btn-secondary button-link button-panel" title="Excluir">
                      <span class="fa fa-trash fa-fw" aria-hidden="true"></span>
                    </button>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  @endsection
