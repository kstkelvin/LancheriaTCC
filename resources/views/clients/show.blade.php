@extends('layouts.master')


@section('content')

  <div class=heftymargins>
    <h2>{{ $client->name . ' ' . $client->surname }}</h2>
    <hr>
    {{ 'Setor: ' . $client->setor }}
    <br>
    {{ 'Telefone:' . $client->phone_number}}
    <hr>
    <a href="/client/{{$client->id}}/edit" class="btn btn-success">Editar</a>
  </div>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Produto</th>
        <th>Valor</th>
        <th>Quantidade</th>
        <th>Hora da Compra</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($items as $item)
        <tr>
          <td>{{ $item->name }}</td>
          <td>{{ 'R$ ' . number_format($item->value, 2, ',', '.') }}</td>
          <td>{{ $item->amount }}</td>
          <td>{{ $item->time }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection
