@extends('layouts.master')


@section('content')

  <div class="marging-padding">
    <h1>Cliente: {{ $client->name . ' ' . $client->surname }}</h1>
    <hr>
    {{ 'Setor: ' . $client->setor }}
    <br>
    {{ 'Telefone: ' . $client->phone_number}}
    <br>
    {{ 'Total: R$ ' . number_format($total->total, 2, ',', '.') }}
    <form action="/cliente/{{$client->id}}/excluir" method="POST">
      {{csrf_field()}}
      <a href="/cliente/{{$client->id}}/editar" class="btn linkbutton">
        <i class="fa fa-fw fa-pencil"></i></a>
      <a href="/cliente/{{$client->id}}/pagamento" class="btn linkbutton">
        <i class="fa fa-fw fa-money"></i></a>
      <input type="hidden" name="id" value="{{$client->id}}" />
      <button type="submit" class="btn linkbutton">
        <i class="fa fa-fw fa-trash"></i>
      </button>
    </form>
    <hr>

  </div>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Produto</th>
        <th>Valor</th>
        <th>Quantidade</th>
        <th>Hora da Compra</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($items as $item)
        <tr>
          <td>{{ $item->name }}</td>
          <td>{{ 'R$ ' . number_format($item->value, 2, ',', '.') }}</td>
          <td>{{ $item->amount }}</td>
          <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i:s') }}</td>
          <td>
            <form action="/venda/{{$item->id}}/excluir" method="POST">
              {{csrf_field()}}
              <input type="hidden" name="id" value="{{$item->id}}" />
              <button type="submit" class="linkbutton">
                <span class="fa fa-trash fa-fw" aria-hidden="true"></span>
              </button>
            </form>
          </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @endsection
