@extends('layouts.master')
@section('content')
  <br>
  <form action="/cliente/{{$client->id}}/excluir" id="delete_client" method="POST">
    {{csrf_field()}}
    <input type="hidden" name="id" value="{{$client->id}}" />
  </form>
  @if($client->user_id != 0)
    <form action="/mail/{{$client->user_id}}" id="mailsend_dorkadory" method="POST">
      {{csrf_field()}}
      <input type="hidden" name="id" value="{{$client->usuario}}"></input>                           
    </form>
  @endif
  <div class="album">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card-body card mb-12 box-shadow">
            @if($client->surname != null)
              <h1>Cliente: {{ $client->name . ' ' . $client->surname }}</h1>
            @else
              <h1>Cliente: {{ $client->name }}</h1>
            @endif
            @if($client->user_id != 0)

              <p>{{ 'E-mail: ' . $user->email}}<br>
                {{'Setor: ' . $client->setor }}<br>
                {{'Telefone: ' . $client->phone_number}}<br>
                {{"Total: " . number_format($client->total, 2, ',', '.') . " R$"}}</p>

              @else
                <p>{{'Setor: ' . $client->setor }}<br>
                  {{'Telefone: ' . $client->phone_number}}<br>
                  {{"Total: " . number_format($client->total, 2, ',', '.') . " R$"}}</p>
                @endif
                <div class="form-group d-flex justify-content-start align-items-start flex-column flex-md-row form-inline">
                  <a href="/cliente/{{$client->id}}/editar" class="d-md-inline-block btn btn-sm btn-secondary mr-1" title="Editar">
                    <span class="fa fa-pencil fa-fw" aria-hidden="true"></span>Editar
                  </a>

                  <button type="submit" form="delete_client" formmethod="post" onclick="return delete_confirm_client()" class="mr-1 d-md-inline-block btn btn-sm btn-secondary" title="Excluir">
                    <span class="fa fa-trash fa-fw" aria-hidden="true"></span>Excluir
                  </button>

                  <a href="/cliente/{{$client->id}}/historico" class="d-md-inline-block mr-1 btn btn-sm btn-secondary" title="Histórico">
                    <span class="fa fa-history fa-fw" aria-hidden="true"></span>Histórico
                  </a>
                  @if($client->total > 0.00)
                    <button class="d-md-inline-block btn btn-sm mr-1 btn-secondary" id="myBtn"><span class="fa fa-money fa-fw" aria-hidden="true"></span>Pagamento</button>
                  @endif
                  @if($client->user_id == null)
                    <a href="/cliente/{{$client->id}}/bind" class="d-md-inline-block btn btn-sm btn-secondary" title="Vincular a Conta">
                      <span class="fa fa-plus fa-fw" aria-hidden="true"></span>Conta
                    </a>
                    <button type="submit" form="mailsend_dorkadory" formmethod="post" class="d-md-inline-block btn btn-sm btn-secondary" title="Enviar">
                      Enviar E-mail
                    </button>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
          <div class="modal-header">
            <h2>Pagamento</h2>
            <span class="close">&times;</span>
          </div>
          <div class="modal-body">
            <form action="/cliente/{{$client->id}}/pagamento" method="POST">
              {{csrf_field()}}
              <fieldset>
                <input type="hidden" name="id" value="{{$client->id}}" />
                <div class="form-group">
                  <input type="radio" class="control-label" id="payment_1" name="payment_option" value="1" onChange="disablefield();" checked="true">
                  Pagamento total: {{ number_format($client->total, 2, ',', '.') . " R$"}}
                </div>
                <div class="form-group">
                  <input type="radio" class="control-label" id="payment_2" name="payment_option" onChange="disablefield();" value="2" > Pagamento parcial:
                </div>
                <div class="form-group">
                  <div class="col-lg-12">
                    <input type="number" class="form-control" id="payment" size="99" step="0.01"
                    placeholder="0,00" name="payment" disabled="disabled">
                    <br>
                  </div>
                </div>
                <div class="form-group text-center">
                  <p>Tem certeza de que deseja continuar com o procedimento?</p>
                  <div class="btn-group d-flex justify-content-center form-inline">
                    <button type="submit" class="btn btn-md btn-primary">Confirmar</button>
                    <button type="button" class="btn btn-danger btn-md shutoff">Cancelar</button>
                  </div>
                </div>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
      <br>
      <center>
        {!! $chart_clients->html() !!}
      </center>
      <table class="table table-striped">
        <thead>
          <tr>
            <th><p class="table-header-wordwrap">PRODUTO</p></th>
            <th><p class="table-header-wordwrap">VALOR</p></th>
            <th><p class="table-header-wordwrap">QUANTIDADE</p></th>
            <th><p class="table-header-wordwrap">DATA</p></th>
            <th><p class="table-header-wordwrap"></p></th>
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
                  <button type="submit" onclick="return delete_confirm_sell()" class="button-link">
                    <span class="fa fa-trash fa-fw" aria-hidden="true" target="blank"
                    title="Excluir"></span>
                  </button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @endsection
  {!! Charts::scripts() !!}
  {!! $chart_clients->script() !!}
