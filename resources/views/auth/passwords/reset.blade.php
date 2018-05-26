@extends('layouts.master')

@section('content')
  <div class="album">
    <div class="container">
      <div class="row form-body">
        <div class="col-md-4">
          <div class="card-body card mb-4 box-shadow">
            <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
              <div class="text-center mb-4">
                <h1 class="h3 mb-3 font-weight-normal">Recuperação de Senha</h1>
              </div>
              {{ csrf_field() }}
              <input type="hidden" name="token" value="{{ $token }}">
              <div class="form-group">
                <div class="form-label-group">
                  <input id="email" type="email" class="form-control" placeholder="Endereço de E-mail" name="email" value="{{ $email or old('email') }}" required autofocus>
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <input id="password" type="password" placeholder="Senha"  class="form-control" name="password" required>
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <input id="password-confirm" type="password" placeholder="Repita a Senha" class="form-control" name="password_confirmation" required>
                </div>
              </div>
              <div class="form-group">
                <button class="btn btn-lg btn-primary btn-block" type="submit">Alterar Senha</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
