@extends('layouts.master')
@section('content')
  <br>
  <form action="/visitantes/cancelar" id="cancel_the_whole_thing" method="POST">
    {{csrf_field()}}
  </form>
  <div class="album">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card-body card mb-12 box-shadow">
            <div class="mb-4">
              <h1 class="h3 mb-3 font-weight-normal">Operação de Venda - Visitantes</h1>
              {{ 'Total: R$ ' . number_format($total->total, 2, ',', '.') }}
            </div>
            <div class="form-group d-flex justify-content-start align-items-start flex-column flex-md-row form-inline">

              <button type="submit" id="myBtn2" class="d-md-inline-block btn btn-sm btn-secondary" title="Adicionar ao carrinho">
                @if($total->total > 0.00)<span class="fa fa-shopping-cart fa-fw" aria-hidden="true"></span>Adicionar
                @else <span class="fa fa-shopping-cart fa-fw" aria-hidden="true"></span>Adicionar ao Carrinho
                @endif
              </button>

              @if($total->total > 0.00)
                <button type="submit" form="cancel_the_whole_thing" formmethod="post" onclick="return delete_confirm_cancel()"
                class="d-md-inline-block btn btn-sm btn-secondary mr-1" title="Excluir">
                  <span class="fa fa-ban fa-fw" aria-hidden="true"></span>Cancelar
                </button>
              @endif
              @if($total->total > 0.00)
                <button type="submit" id="myBtn" class="d-md-inline-block btn btn-sm btn-secondary" title="Pagamento">
                  <span class="fa fa-money fa-fw" aria-hidden="true"></span>Pagamento
                </button>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <br>
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
            <form action="/visitantes/{{$item->id}}/excluir" method="POST">
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


<div id="myModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <h2>Pagamento</h2>
      <span class="close">&times;</span>
    </div>
    <div class="modal-body">
      <form action="/visitantes/pagamento" method="POST">
        {{csrf_field()}}
        <fieldset>
          <div class="form-group">
            <br>
            <p>Pagamento total: {{ number_format($total->total, 2, ',', '.') . " R$"}}</p>
          </div>
          <div class="form-group">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Produto</th>
                  <th>Valor</th>
                  <th>Quantidade</th>
                  <th>Data</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($items as $item)
                  <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ 'R$ ' . number_format($item->price, 2, ',', '.') }}</td>
                    <td>{{ $item->amount }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i:s') }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="form-group text-center">
            <p>Tem certeza de que deseja continuar com o procedimento?</p>
            <div class="btn-group d-flex justify-content-center flex-column flex-md-row form-inline">
              <button type="submit" class="btn btn-md btn-primary">Sim, Confirme o Pagamento.</button>
              <button type="button" class="btn btn-danger btn-md shutoff">Não, Me tire daqui!</button>
            </div>
          </div>
        </fieldset>
      </form>
    </div>
  </div>
</div>

<div id="myModal2" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h2>Adicionar Compras</h2>
      <span class="close">&times;</span>
    </div>
    <div class="modal-body">
      <form method="post" action="/visitantes" class="form-horizontal">
        {{ csrf_field() }}
        <fieldset>
          <div class="form-group">
              <select name="product_id" class="form-control" id="product_id" required>
                <option disabled selected value>Produto</option>
                @foreach ($products as $product)
                  <option value="{{$product->id}}">{{$product->name}}</option>
                @endforeach
              </select>
          </div>
          <div class="form-group">
              <input class="form-control" type="number" id="amount" name="amount" placeholder="Quantia" required>
          </div>
          <br>
          <div class="form-group text-center">
            <p>Tem certeza de que deseja adicionar este produto na lista?</p>
            <div class="btn-group d-flex justify-content-center form-inline">
              <button type="submit" class="btn btn-md btn-primary">Adicionar</button>
              <button type="button" class="btn btn-md btn-danger shutoff">Cancelar</button>
            </div>
          </div>
        </fieldset>
      </form>

    </div>
  </div>
</div>
@endsection
