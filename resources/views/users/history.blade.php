@extends('layouts.master')
@section('content')
  <br>
  <div class="album">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card-body card box-shadow">
              <h1>{{ $client->name }}: Histórico</h1>
            <p>{{ 'Setor: ' . $client->setor }}<br>
              {{ 'Telefone: ' . $client->phone_number}}</p>
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
