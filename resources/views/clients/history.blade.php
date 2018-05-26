@extends('layouts.master')
@section('content')
  <br>
  <form action="/cliente/{{$client->id}}/excluir" id="delete_client" method="POST">
    {{csrf_field()}}
    <input type="hidden" name="id" value="{{$client->id}}" />
  </form>
  <div class="album">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card-body card mb-12 box-shadow">
            @if($client->surname != null)
              <h1>Histórico: {{ $client->name . ' ' . $client->surname }}</h1>
            @else
              <h1>Histórico: {{ $client->name }}</h1>
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
                  @if($client->user_id == null)
                    <a href="/cliente/{{$client->id}}/bind" class="d-md-inline-block btn btn-sm btn-secondary" title="Vincular a Conta">
                      <span class="fa fa-plus fa-fw" aria-hidden="true"></span>Conta
                    </a>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <br>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <table class="table table-hover table-striped">
              <thead>
                <tr>
                  <th><p class="table-header-wordwrap">PRODUTO</p></th>
                  <th><p class="table-header-wordwrap">QUANTIA</p></th>
                  <th><p class="table-header-wordwrap">DATA</p></th>
                  <th><p class="table-header-wordwrap">PAGO?</p></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($items as $item)
                  <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->amount }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i:s') }}</td>
                    <td>
                      @if($item->pago != 0)  Sim
                      @else Não
                      @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    @endsection
