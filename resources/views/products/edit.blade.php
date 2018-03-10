@extends('layouts.master')

@section('content')

  <h1>Produto: {{$product->name}} - Editar</h1>
  <div>
    <a href="/produto/{{$product->id}}" class="btn btn-success linkbutton linkmargin button-panel" title="Voltar">
      <span class="fa fa-long-arrow-left fa-fw" aria-hidden="true"></span> Produto: {{$product->name}}
    </a>
  </div>
  <br>
  <hr>
  <br>
  <form method="post" action="/produto/{{$product->id}}" class="form-horizontal">
      {{ csrf_field() }}
    <fieldset>
      <div class="form-group">
        <label for="name" class="col-lg-2 control-label">Nome</label>
        <div class="col-lg-10">
          <input type="text" class="form-control" id="name" placeholder="Nome"
          name="name" required>
          <br>
        </div>
      </div>

      <div class="form-group">
        <label for="price" class="col-lg-2 control-label">Preço</label>
        <div class="col-lg-10">
          <input type="number" class="form-control" id="price" size="99" step="0.01"
          placeholder="0,00" name="price" required>
          <br>
        </div>
      </div>

      <div class="form-group">
        <div class="col-lg-10 col-lg-offset-2">
          <button type="reset" class="btn btn-default">Limpar</button>
          <button type="submit" class="btn btn-primary">Editar</button>
        </div>
      </div>

    </fieldset>
  </form>
@endsection
