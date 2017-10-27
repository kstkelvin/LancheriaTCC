@extends('layouts.master')

@section('content')

<h1>Edição de Produtos: {{$product->name}}</h1>
<hr>
<form method="post" action="/produto/{{$product->id}}" class="form-horizontal">
  <fieldset>
    {{ csrf_field() }}
    <div class="form-group">
      <label for="name" class="col-lg-2 control-label">Nome</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" id="name" placeholder="Nome"
        name="name" required>
        <br>
      </div>
    </div>

    <div class="form-group">
      <label for="value" class="col-lg-2 control-label">Preço</label>
      <div class="col-lg-10">
        <input type="number" class="form-control" id="value" size="99" step="0.01"
        placeholder="0,00" name="value" required>
        <br>
      </div>
    </div>

    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <button type="reset" class="btn btn-default">Cancelar</button>
        <button type="submit" class="btn btn-primary">Editar</button>
      </div>
    </div>
  </fieldset>
</form>

@endsection
