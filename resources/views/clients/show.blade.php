@extends('layouts.master')


@section('content')

  <div>
    <h1>Cliente: {{ $client->name . ' ' . $client->surname }}</h1>
    <div>
      <a href="/clientes" class="btn btn-success linkbutton linkmargin button-panel" title="Voltar">
        <span class="fa fa-long-arrow-left fa-fw" aria-hidden="true"></span> Lista de Clientes
      </a>
    </div>
    <br>
    <hr>
    @if($client->user_id != 0)
      {{ 'Nome de Usuário: ' . $user->username }}
      <br>
    @endif
    {{ 'Setor: ' . $client->setor }}
    <br>
    {{ 'Telefone: ' . $client->phone_number}}
    <br>
    {{ 'E-mail: ' . $client->email}}
    <br>
    {{ 'Total: R$ ' . number_format($total->total, 2, ',', '.') }}

    <div class="form-group">
      <a href="/cliente/{{$client->id}}/editar" class="btn btn-success linkbutton linkmargin button-panel" title="Editar">
        <span class="fa fa-pencil fa-fw" aria-hidden="true"></span>Editar
      </a>
      <form action="/cliente/{{$client->id}}/excluir" method="POST">
        {{csrf_field()}}
        <input type="hidden" name="id" value="{{$client->id}}" />
        <button type="submit" class="btn btn-success linkbutton linkmargin button-panel" title="Excluir">
          <span class="fa fa-trash fa-fw" aria-hidden="true"></span>Excluir
        </button>
      </form>
      <a href="/cliente/{{$client->id}}/pagamento" class="btn btn-success linkbutton linkmargin button-panel" title="Pagamento">
        <span class="fa fa-money fa-fw" aria-hidden="true"></span>Pagamento
      </a>
      @if($client->user_id == null)
        <a href="/cliente/{{$client->id}}/bind" class="btn btn-success linkbutton linkmargin button-panel" title="Vincular a Conta">
          <span class="fa fa-plus fa-fw" aria-hidden="true"></span>Vincular a Conta
        </a>
      @endif
    </div>



  </div>
  <br>
  <hr>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Produto</th>
        <th>Valor</th>
        <th>Quantidade</th>
        <th>Data</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($items as $item)
        <tr>
          <td>{{ $item->name }}</td>
          <td>{{ 'R$ ' . number_format($item->price, 2, ',', '.') }}</td>
          <td>{{ $item->amount }}</td>
          <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i:s') }}</td>
          <td>
            <form action="/venda/{{$item->id}}/excluir" method="POST">
              {{csrf_field()}}
              <input type="hidden" name="id" value="{{$item->id}}" />
              <button type="submit" class="linkbutton">
                <span class="fa fa-trash fa-fw" aria-hidden="true" target="blank"
                title="Excluir"></span>
              </button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection
