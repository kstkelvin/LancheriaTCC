@extends('layouts.master')

@section('content')
  <div class="marging-padding">
    <section>
      <h3>Cadastro</h3>
      <hr>
    </section>
    <form method="POST" action="/registrar">
      {{ csrf_field() }}

      <div class="form-group">
        <label for="username">Nome de usuário</label>
        <input type="text" class="form-control" id="userame"
        name="username" required>
      </div>

      <div class="form-group">
        <label for="password">Senha</label>
        <input type="password" class="form-control" id="password"
        name="password" minlength="8" required>
      </div>

      <div class="form-group">
        <label for="password_confirmation">Confirmar Senha</label>
        <input type="password" class="form-control" id="password_confirmation"
        name="password_confirmation" maxlenght="40" required>
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary">Cadastrar</button>
      </div>

    </form>
  </div>

@endsection
