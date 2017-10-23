@extends('layouts.master')


@section('content')

  <div class="marging-padding">
    <h3>{{ $client->name . ' ' . $client->surname }}</h3>
    {{ 'Setor: ' . $client->setor }}
    <br>
    {{ 'Telefone: ' . $client->phone_number}}
    <br>
    {{ 'Total: R$ ' . number_format($total->total, 2, ',', '.') }}
    <hr>
    <a href="/cliente/{{$client->id}}/editar" class="btn btn-primary mr-1">Editar</a>
    <a href="/cliente/{{$client->id}}/pagamento" class="btn btn-success">Pagamento</a>
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
          <td>{{ \Carbon\Carbon::parse($item->created_at)
            ->format('d/m/Y H:i:s') }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @endsection
