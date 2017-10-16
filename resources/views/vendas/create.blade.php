@extends('layouts.master')

@section('content')
  <div class="heftymargins">
    <h2>Nova Venda</h2>
  </div>
  <form method="post" action="/venda">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="client_id">Id do Cliente</label>
      <input class="form-control" type="number" id="client_id" name="client_id">
    </div>
    <div class="form-group">
      <label for="product_id">Id do Produto</label>
      <input class="form-control" type="number" id="product_id" name="product_id">
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
