@extends('layouts.master')

@section('content')
  <h1>Editar Dados</h1>
  <hr>
  <form method="POST" action="/editar" class="form-horizontal">
    {{ csrf_field() }}
    <fieldset>

      <div class="form-group">
        <label for="name" class="col-lg-2 control-label">Nome</label>
        <div class="col-lg-10">
          <input type="text" class="form-control" id="name"
          name="name" required>
          <br>
        </div>
      </div>

      <div class="form-group">
        <label for="surname" class="col-lg-2 control-label">Sobrenome</label>
        <div class="col-lg-10">
          <input type="text" class="form-control" id="surname"
          name="surname">
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
