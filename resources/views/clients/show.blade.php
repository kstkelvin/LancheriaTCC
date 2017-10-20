@extends('layouts.master')


@section('content')

  <div class=heftymargins>
    <h2>{{ $client->name . ' ' . $client->surname }}</h2>
    <hr>
    {{ 'Setor: ' . $client->setor }}
    <br>
    {{ 'Telefone: ' . $client->phone_number}}
    <br>
    {{ 'Total: R$ ' . number_format($total->total, 2, ',', '.') }}
    <br>
    <a href="/cliente/{{$client->id}}/editar" class="startingpad">Editar</a>
    <a href="/cliente/{{$client->id}}/pagamento" class="endingpad">Pagamento</a>
    <hr>
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
            ->timezone(Config::get('app.timezone'))
            ->format('d/m/Y m:i:s') }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @endsection
