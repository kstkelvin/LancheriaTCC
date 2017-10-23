@extends('layouts.master')

@section('content')
  <div class="marging-padding">
    <div>
      <h2>Lista de Clientes</h2>
    </div>
    <hr>
    <form method="GET" class="form-group form-inline" action="/clientes/pesquisar">
      <input id="search" name="search" class="form-control mr-sm-2" type="text"
      placeholder="Digite o nome do cliente">
      <button type="submit" class="btn btn-outline-success">
        Pesquisar
      </button>
    </form>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Setor</th>
          <th>Telefone</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($clients as $client)
          <tr>
            <td><a href="/cliente/{{$client->id}}">{{ $client->name . " " .
              $client->surname }}</a></td>
              <td>{{ $client->setor }}</td>
              <td>{{ $client->phone_number }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <hr>
      <div class="d-flex justify-content-end">
        <a href="/clientes/adicionar" class="btn btn-success">Novo Cliente</a>
      </div>
    </div>
  @endsection
