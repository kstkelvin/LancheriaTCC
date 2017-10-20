@extends('layouts.master')

@section('content')

  <div class=heftymargins>
    <h2>{{$product->name . ': '}}Editar</h2>
    <hr>
    <br>

    <form method="post" action="/produto/{{$product->id}}">
      {{csrf_field()}}
      <div class="form-group">
        <label for="name">Nome do Produto</label>
        <input type="text" class="form-control" id="name" placeholder="{{$product->name}}"
        name="name" required>
      </div>

      <div class="form-group">
        <label for="value">Preço</label>
        <input type="number" class="form-control" id="value" size="99" step="0.01"
        placeholder="{{$product->value}}" name="value" required>
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary">Editar</button>
      </div>
    </form>
  </div>
@endsection
