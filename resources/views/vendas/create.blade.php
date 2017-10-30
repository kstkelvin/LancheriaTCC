@extends('layouts.master')

@section('content')

  <h1>Nova Venda</h1>
  <div>
    <a href="/" class="btn btn-success linkbutton linkmargin button-panel" title="Voltar">
      <span class="fa fa-long-arrow-left fa-fw" aria-hidden="true"></span> Homepage
    </a>
  </div>
  <br>
  <hr>
  <br>
  <form method="post" action="/venda" class="form-horizontal">
    {{ csrf_field() }}

    <fieldset>

      <div class="form-group">
        <label for="client_id" class="col-lg-2 control-label">Cliente</label>
        <div class="col-lg-10">
          <select name="client_id" class="form-control" id="client_id" required>
            <option disabled selected value>Selecione o cliente</option>
            @foreach ($clients as $client)
              <option value="{{$client->id}}">{{$client->name}}</option>
            @endforeach
          </select>
          <br>
        </div>
      </div>

      <div class="form-group">
        <label for="product_id" class="col-lg-2 control-label">Produto</label>
        <div class="col-lg-10">
          <select name="product_id" class="form-control" id="product_id" required>
            <option disabled selected value>Selecione o produto</option>
            @foreach ($products as $product)
              <option value="{{$product->id}}">{{$product->name}}</option>
            @endforeach
          </select>
          <br>
        </div>
      </div>

      <div class="form-group">
        <label for="amount" class="col-lg-2 control-label">Quantia</label>
        <div class="col-lg-10">
          <input class="form-control" type="number" id="amount" name="amount">
          <br>
        </div>
      </div>

      <div class="form-group">
        <div class="col-lg-10 col-lg-offset-2">
          <button type="reset" class="btn btn-default">Limpar</button>
          <button type="submit" class="btn btn-primary">Cadastrar</button>
        </div>
      </div>
    </fieldset>
  </form>

@endsection
