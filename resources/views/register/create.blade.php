@extends('layouts.master')

@section('content')
  <h1>Cadastro</h1>
  <hr>
  <form method="POST" action="/registrar" class="form-horizontal">
    {{ csrf_field() }}
    <fieldset>

      <div class="form-group">
        <label for="username" class="col-lg-2 control-label">Nome de usuário</label>
        <div class="col-lg-10">
          <input type="text" class="form-control" id="username"
          name="username" required>
          <br>
        </div>
      </div>

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
        <label for="email" class="col-lg-2 control-label">E-mail</label>
        <div class="col-lg-10">
          <input type="email" class="form-control" id="email" name="email"
          required>
          <br>
        </div>
      </div>

      <div class="form-group">
        <label for="password" class="col-lg-2 control-label">Senha</label>
        <div class="col-lg-10">
          <input type="password" class="form-control" id="password"
          name="password" minlength="8" required>
          <br>
        </div>
      </div>

      <div class="form-group">
        <label for="password_confirmation" class="col-lg-2 control-label">Confirmação da Senha</label>
        <div class="col-lg-10">
          <input type="password" class="form-control" id="password_confirmation"
          name="password_confirmation" maxlenght="40" required>
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
