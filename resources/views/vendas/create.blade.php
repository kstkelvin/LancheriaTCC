@extends('layouts.master')

@section('content')
  <br>
  <div class="container">
    <div class="row form-body">
      <div class="col-md-6">
        <div class="card-body card mb-6 box-shadow">
          <form method="post" action="/venda" class="form-horizontal">
            {{ csrf_field() }}

            <fieldset>
              <div>
                <div class="text-center mb-4">
                  <h1 class="h3 mb-3 font-weight-normal">Operação de Venda - Funcionários</h1>
                </div>
                <div>

                  <div class="form-group">
                    <div class="form-label-group">
                      <label for="client_id" class="bmd-label-floating">Cliente</label>
                      <select name="client_id" class="form-control" id="client_id" required>
                        <option disabled selected value>Selecione o cliente</option>
                        @foreach ($clients as $client)
                          <option value="{{$client->id}}">{{$client->name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="form-label-group">
                      <label for="product_id" class="bmd-label-floating">Produto</label>
                      <select name="product_id" class="form-control" id="product_id" required>
                        <option disabled selected value>Selecione o produto</option>
                        @foreach ($products as $product)
                          <option value="{{$product->id}}">{{$product->name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="form-label-group">
                      <label for="amount" class="bmd-label-floating">Quantia</label>
                      <input class="form-control" type="number" id="amount" name="amount" required autofocus>
                    </div>
                  </div>

                  <div class="form-group">
                    <button class="btn btn-lg btn-primary btn-block " type="submit">Cadastrar</button>
                  </div>
                </div>
              </div>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
