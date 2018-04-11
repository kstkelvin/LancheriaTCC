@extends('layouts.master')


@section('content')

  <div>
    <h1>{{ $client->name . ' ' . $client->surname }}: Conta</h1>
    <hr>
    {{ 'Setor: ' . $client->setor }}
    <br>
    {{ 'Telefone: ' . $client->phone_number}}
    <br>
    {{ 'Total: R$ ' . number_format($total->total, 2, ',', '.') }}
  </div>
  <br>
  <hr>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Produto</th>
        <th>Valor</th>
        <th>Qt.</th>
        <th>Data</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($items as $item)
        <tr>
          <td>{{ $item->name }}</td>
          <td>{{ 'R$ ' . number_format($item->price, 2, ',', '.') }}</td>
          <td>{{ $item->amount }}</td>
          <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i:s') }}</td>
          <td>{{ 'R$ ' . number_format($item->price * $item->amount, 2, ',', '.') }}</td>
          <td>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection
