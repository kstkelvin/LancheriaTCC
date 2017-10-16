@extends('layouts.master')

@section('content')
  <div class="heftymargins">
    <h2>Nova Venda</h2>
  </div>
  <form method="post" action="/venda">
    {{ csrf_field() }}

    <div class="form-group">
      <label for="setor">Cliente</label>
      <select name="client_id" class="form-control" id="client_id" required>
        @foreach ($clients as $client)
          <option value="{{$client->id}}">{{$client->name}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="setor">Produto</label>
      <select name="product_id" class="form-control" id="product_id" required>
        @foreach ($products as $product)
          <option value="{{$product->id}}">{{$product->name}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="amount">Quantia</label>
      <input class="form-control" type="number" id="amount" name="amount">
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-primary" name="button">Finalizar</button>
    </div>
  </form>

@endsection
