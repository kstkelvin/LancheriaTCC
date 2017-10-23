@extends('layouts.master')

@section('content')
  <div class="marging-padding">
    <div>
      <h3>Entrar</h3>
      <hr>
    </div>
    <form method="post" action="/login">
      {{ csrf_field() }}
      <div class="form-group">
        <label for="username">Nome de Usuário</label>
        <input type="text" class="form-control" id="username" name="username">
      </div>
      <div class="form-group">
        <label for="password">Senha</label>
        <input type="password" class="form-control" id="password" name="password">
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary">Login</button>
      </div>
    </form>
  </div>
@endsection
