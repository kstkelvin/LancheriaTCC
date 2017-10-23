@extends('layouts.master')

@section('content')

  <div class="marging-padding">
    <h2>{{$product->name . ': '}}Estoque</h2>
    <br>
    <form method="post" action="/produto/{{$product->id}}/armazem">
      {{csrf_field()}}
      <div class="form-group">
        <label for="stock">Estoque</label>
        <input type="number" class="form-control" id="stock"
        placeholder="{{$product->stock}}" name="stock" required>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary">Adicionar Estoque</button>
      </div>
    </form>
  </div>
@endsection
