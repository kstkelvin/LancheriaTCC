@extends('layouts.master')

@section('content')
  <h1>Cadastro de Produtos</h1>
  <div>
    <a href="/produtos" class="btn btn-success linkbutton linkmargin button-panel" title="Voltar">
      <span class="fa fa-long-arrow-left fa-fw" aria-hidden="true"></span> Lista de Produtos
    </a>
  </div>
  <br>
  <hr>
  <br>
  <form method="POST" action="/produtos" class="form-horizontal">
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
          <button type="reset" class="btn btn-default">Limpar</button>
          <button type="submit" class="btn btn-primary">Cadastrar</button>
        </div>
      </div>
    </fieldset>
  </form>

@endsection
