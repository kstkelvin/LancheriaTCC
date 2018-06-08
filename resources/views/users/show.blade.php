@extends('layouts.master')
@section('content')
  <br>
  <div class="album">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card-body card box-shadow">
            <h1>{{ $client->name }}: Conta</h1>
            <p>{{ 'Setor: ' . $client->setor }}<br>
              {{ 'Telefone: ' . $client->phone_number}}<br>
              {{ 'Total: R$ ' . number_format($total->total, 2, ',', '.') }}</p>
              <div class="form-group d-flex justify-content-start align-items-start flex-column flex-md-row form-inline">
                <a href="/historico" class="d-md-inline-block btn btn-sm btn-secondary mr-1" title="Histórico">
                  <span class="fa fa-history fa-fw" aria-hidden="true"></span>Histórico
                </a>
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
                <th><p class="table-header-wordwrap">TOTAL</p></th>
                <th><p class="table-header-wordwrap">DATA DA COMPRA</p></th>

              </tr>
            </thead>
            <tbody>
              @foreach ($items as $item)
                <tr>
                  <td>{{ $item->name . ' (R$' . number_format($item->price, 2, ',', '.').')' }}</td>
                  <td>{{ $item->amount }}</td>
                  <td>{{ 'R$ ' . number_format($item->price * $item->amount, 2, ',', '.') }}</td>
                  <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i:s') }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  @endsection
