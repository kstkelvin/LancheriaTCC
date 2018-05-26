@extends('layouts.master')

@section('content')
  <br>
  <div class="album">
    <div class="container">
      <div class="row form-body">
        <div class="col-md-4">
          <div class="card-body card mb-4 box-shadow">
            <form class="form-signin" method="POST" action="{{ route('password.email') }}">
              <div class="text-center mb-4">
                <h1 class="h3 mb-3 font-weight-normal">Recuperação de Senha</h1>
              </div>
              {{ csrf_field() }}
              <div class="form-group">
                <div class="form-label-group">
                  <input id="email" type="email" class="form-control" placeholder="Endereço de E-mail" name="email" required autofocus>
                </div>
              </div>
              <div class="form-group">
                <button class="btn btn-lg btn-primary btn-block" type="submit">Recuperar Senha</button>
              </div>
              <p class="intro-login">Não possui uma conta? <a href="/registrar">Cadastre-se</a>.</p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
