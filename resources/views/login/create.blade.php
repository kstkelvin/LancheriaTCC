@extends('layouts.master')

@section('content')

  <h1>Login</h1>
  <hr>

  <form method="post" action="/login"  class="form-horizontal">
    {{ csrf_field() }}
    <fieldset>

      <div class="form-group">
        <label for="username" class="col-lg-2 control-label">Nome de usuário</label>
        <div class="col-lg-10">
          <input type="text" class="form-control" id="userame"
          name="username" required>
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
        <div class="col-lg-10 col-lg-offset-2">
          <button type="reset" class="btn btn-default">Limpar</button>
          <button type="submit" class="btn btn-primary">Entrar</button>
        </div>
      </div>
    </fieldset>
  </form>

  <p class="thrifty">Não possui uma conta? <a href="/registrar">Cadastre-se</a>.</p>
@endsection
