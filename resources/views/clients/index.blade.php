@extends('layouts.master')

@section('content')
  <div class="heftymargins">
    <h2>Lista de Clientes</h2>
  </div>
  <hr>
  <a href="/clients/create" class="btn btn-success">Novo Cliente</a>
  <hr>
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
          <td><a href="client/{{$client->id}}">{{ $client->name . " " .
            $client->surname }}</a></td>
            <td>{{ $client->setor }}</td>
            <td>{{ $client->phone_number }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @endsection
