@extends('layouts.master')

@section('content')
  <div>
    <h2>Lista de Clientes</h2>
  </div>
  <hr>
  <a href="/clientes/adicionar" class="btn btn-success d-flex justify-content-end">Novo Cliente</a>
  <hr>
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
          <td><a href="cliente/{{$client->id}}">{{ $client->name . " " .
            $client->surname }}</a></td>
            <td>{{ $client->setor }}</td>
            <td>{{ $client->phone_number }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @endsection
